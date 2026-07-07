<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use App\Models\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalStudents = Student::count();

            $totalCollected = Transaction::where('transaction_type', 'payment')->sum('amount');

            // ✅ Fixed outstanding formula – includes concessions and fines
            $totalOutstanding = StudentAccount::selectRaw(
                'SUM(total_fee_due - total_payment_collected - total_concession_applied + levied_fines) as outstanding'
            )->value('outstanding') ?? 0;

            $totalConcessions = StudentAccount::sum('total_concession_applied');

            $recentTransactions = Transaction::with('studentAccount.student')
                ->latest()
                ->limit(10)
                ->get();

            return view('dashboard', compact(
                'totalStudents',
                'totalCollected',
                'totalOutstanding',
                'totalConcessions',
                'recentTransactions'
            ));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }
}