<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\PaymentReceipt;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $student = Student::where('roll_number', $user->roll_number)->first();

        if (!$student) {
            return view('student.no-record', ['user' => $user]);
        }

        $account = $student->studentAccount;
        $transactions = $account ? $account->transactions()->latest()->get() : collect();

        return view('student.dashboard', compact('user', 'student', 'account', 'transactions'));
    }

    public function receipt($id)
    {
        $user = auth()->user();
        $student = Student::where('roll_number', $user->roll_number)->first();

        $receipt = PaymentReceipt::findOrFail($id);
        $receiptStudentId = $receipt->transaction->studentAccount->student->id;

        if (!$student || $receiptStudentId !== $student->id) {
            abort(403, 'Unauthorized');
        }

        return view('receipts.show', compact('receipt'));
    }
}
