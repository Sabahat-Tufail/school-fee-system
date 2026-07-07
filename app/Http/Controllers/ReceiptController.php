<?php

namespace App\Http\Controllers;

use App\Models\PaymentReceipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function show($id)
    {
        try {
            $receipt = PaymentReceipt::with([
                'transaction.studentAccount.student.feeStructure',
                'cashPayment',
                'onlinePayment',
                'creditCardPayment'
            ])->findOrFail($id);

            return view('receipts.show', compact('receipt'));
        } catch (\Exception $e) {
            return back()->with('error', 'Receipt not found or something went wrong.');
        }
    }
}
