<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Transaction;
use App\Models\PaymentReceipt;
use App\Models\CashPayment;
use App\Models\OnlinePayment;
use App\Models\CreditCardPayment;
use App\Models\ConcessionAdjustment;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filterType = $request->input('type'); // payment, concession, fine, or all

            $query = Transaction::with('studentAccount.student');

            if ($filterType && in_array($filterType, ['payment', 'concession', 'fine'])) {
                $query->where('transaction_type', $filterType);
            }

            $transactions = $query->latest()->paginate(10);
            $students = Student::with('feeStructure')->get();

            return view('transactions.index', compact('transactions', 'filterType', 'students'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function store(StoreTransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            // Find student and account
            $student = Student::findOrFail($validated['student_id']);
            $account = $student->studentAccount;

            if (!$account) {
                return back()->with('error', 'Student account not found.')->withInput();
            }

            // Create Transaction record
            $transaction = Transaction::create([
                'transaction_type' => $validated['transaction_type'],
                'transaction_date' => $validated['transaction_date'],
                'amount' => $validated['amount'],
                'category' => $validated['category'],
                'account_id' => $account->id,
            ]);

            // Generate receipt number format: R-YYYY-001
            $year = date('Y', strtotime($validated['transaction_date']));
            $receiptCount = PaymentReceipt::whereYear('created_at', date('Y'))->count() + 1;
            $receiptNumber = 'R-' . $year . '-' . str_pad($receiptCount, 3, '0', STR_PAD_LEFT);

            // Create PaymentReceipt
            $receipt = PaymentReceipt::create([
                'receipt_number' => $receiptNumber,
                'payment_mode' => $validated['payment_mode'],
                'late_fine_levied' => $validated['late_fine_levied'] ?? 0,
                'transaction_id' => $transaction->id,
            ]);

            // Create payment details based on mode
            if ($validated['payment_mode'] === 'cash') {
                CashPayment::create([
                    'window_number' => $validated['window_number'],
                    'book_reference' => $validated['book_reference'],
                    'cashier_name' => $validated['cashier_name'],
                    'receipt_id' => $receipt->id,
                ]);
            } elseif ($validated['payment_mode'] === 'online') {
                OnlinePayment::create([
                    'bank_name' => $validated['bank_name'],
                    'iban' => $validated['iban'],
                    'bank_reference_number' => $validated['bank_reference_number'],
                    'receipt_id' => $receipt->id,
                ]);
            } elseif ($validated['payment_mode'] === 'credit_card') {
                CreditCardPayment::create([
                    'authorization_code' => $validated['authorization_code'],
                    'card_brand' => $validated['card_brand'],
                    'card_last_four' => $validated['card_last_four'],
                    'receipt_id' => $receipt->id,
                ]);
            }

            // Create ConcessionAdjustment if transaction type is concession
            if ($validated['transaction_type'] === 'concession') {
                ConcessionAdjustment::create([
                    'concession_type' => $validated['concession_type'],
                    'percentage' => $validated['percentage'],
                    'authorization_ref' => $validated['authorization_ref'],
                    'transaction_id' => $transaction->id,
                ]);
            }

            // Update StudentAccount balances
            if ($validated['transaction_type'] === 'payment') {
                $account->total_payment_collected += $validated['amount'];
            } elseif ($validated['transaction_type'] === 'concession') {
                $account->total_concession_applied += $validated['amount'];
            } elseif ($validated['transaction_type'] === 'fine') {
                $account->levied_fines += $validated['amount'];
            }
            $account->save();

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Transaction saved successfully. Receipt ID: ' . $receipt->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }
}
