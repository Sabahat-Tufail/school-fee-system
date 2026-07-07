@extends('layouts.receipt')

@section('title', 'Receipt')

@section('content')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .print-only {
            display: block !important;
        }
        body {
            background: white !important;
        }
        main {
            padding: 0 !important;
        }
        header {
            display: none !important;
        }
        aside {
            display: none !important;
        }
    }
</style>

<div class="max-w-2xl mx-auto space-y-6">
    <!-- Back & Print Buttons (Non-print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-2xl" style="border: 1px solid #F2D5E0; box-shadow: 0 2px 10px rgba(92,64,86,0.07);">
        @php
            $backRoute = auth()->user()->role === 'admin' ? route('transactions.index') : route('student.dashboard');
        @endphp
        <a href="{{ $backRoute }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border font-semibold text-sm transition-colors"
           style="border-color: #D9A99A; color: #7A6B72; background: #fff;"
           onmouseover="this.style.background='#FBF3F5';"
           onmouseout="this.style.background='#fff';">
            &larr; Back
        </a>
        <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
                style="background: #5C2A3E;">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.821V7.5a.75.75 0 0 1 .22-.53l3.5-3.5A.75.75 0 0 1 11 3.25h6.25a.75.75 0 0 1 .75.75v9.821m-11.25 0H18m-11.25 0H3.75a.75.75 0 0 1-.75-.75V8.5h3.47m11.25 3.571H20.25a.75.75 0 0 0 .75-.75V8.5h-3.47m0 5.321V19.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75v-5.679m11.25 0H6.75" />
            </svg>
            <span>Print Receipt</span>
        </button>
    </div>

    <!-- Receipt Card -->
    <div class="relative bg-white rounded-2xl overflow-hidden min-h-[500px] flex flex-col justify-between" style="border: 1px solid #D9A99A; box-shadow: 0 4px 20px rgba(92,42,62,0.1);">
        
        <!-- Sage Green diagonal "PAID" Watermark -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.12] select-none z-0">
            <span class="text-8xl md:text-9xl font-black tracking-widest border-8 p-6 rounded-3xl transform -rotate-12"
                  style="color: #A9C9A4; border-color: #A9C9A4;">
                PAID
            </span>
        </div>

        <div class="relative z-10">
            <!-- Header (Deep Mauve Plum background) -->
            <div class="px-6 py-6 text-white flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4" style="background: #5C2A3E;">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl flex items-center justify-center text-white border" style="background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.2);">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A5.905 5.905 0 0 1 1.091 7.497 4.907 4.907 0 0 1 6.18 4.25a5.002 5.002 0 0 1 6.03 1.07 5.002 5.002 0 0 1 6.03-1.07 4.907 4.907 0 0 1 5.087 3.247 5.905 5.905 0 0 1-3.413 2.657 50.567 50.567 0 0 0-2.658.813M4.26 10.147a48.674 48.674 0 0 0 15.48 0" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-extrabold uppercase tracking-wide">AL-NOOR SCHOOL</h4>
                        <p class="text-2xs font-medium" style="color: #C98A9E;">Fee Management System</p>
                    </div>
                </div>
                <div class="text-left sm:text-right">
                    <h3 class="text-lg font-black uppercase tracking-wider" style="color: #D9A99A;">PAYMENT RECEIPT</h3>
                    <p class="text-2xs font-semibold mt-0.5" style="color: #FBF3F5;">Receipt No: {{ $receipt->receipt_number }}</p>
                </div>
            </div>

            <!-- Student Info & Metadata Grid -->
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 border-b text-sm" style="background: #FBF3F5; border-color: #D9A99A;">
                <div class="space-y-1">
                    <p class="text-2xs font-bold uppercase tracking-wider" style="color: #7A6B72;">Student Details</p>
                    <p class="font-bold text-gray-900">{{ $receipt->transaction->studentAccount->student->first_name ?? 'N/A' }} {{ $receipt->transaction->studentAccount->student->last_name ?? '' }}</p>
                    <p class="text-xs font-semibold" style="color: #7A6B72;">
                        {{ $receipt->transaction->studentAccount->student->feeStructure->class_name ?? 'N/A' }} 
                        @if($receipt->transaction->studentAccount->student->feeStructure->section)
                            - Section {{ $receipt->transaction->studentAccount->student->feeStructure->section }}
                        @endif
                    </p>
                </div>
                <div class="space-y-1 sm:text-right">
                    <p class="text-2xs font-bold uppercase tracking-wider" style="color: #7A6B72;">Payment Metadata</p>
                    <p style="color: #3A2E36;" class="font-semibold"><span class="text-xs font-normal" style="color: #7A6B72;">Date:</span> {{ date('M d, Y', strtotime($receipt->transaction->transaction_date)) }}</p>
                    <p style="color: #3A2E36;" class="font-semibold"><span class="text-xs font-normal" style="color: #7A6B72;">Mode:</span> {{ ucfirst($receipt->payment_mode) }}</p>
                </div>
            </div>

            <!-- Conditional Payment Mode Details Box -->
            <div class="px-6 py-4 border-b text-xs" style="border-color: #D9A99A;">
                @if($receipt->cashPayment)
                    <div class="grid grid-cols-3 gap-2 p-3 rounded-lg border text-gray-600 font-medium" style="background: #FBF3F5; border-color: #D9A99A;">
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Window No</span>{{ $receipt->cashPayment->window_number }}</div>
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Book Ref</span>{{ $receipt->cashPayment->book_reference }}</div>
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Cashier</span>{{ $receipt->cashPayment->cashier_name }}</div>
                    </div>
                @elseif($receipt->onlinePayment)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 p-3 rounded-lg border text-gray-600 font-medium" style="background: #FBF3F5; border-color: #D9A99A;">
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Bank Name</span>{{ $receipt->onlinePayment->bank_name }}</div>
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Bank Ref No</span>{{ $receipt->onlinePayment->bank_reference_number }}</div>
                        <div class="sm:col-span-1 overflow-x-auto"><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">IBAN</span>{{ $receipt->onlinePayment->iban }}</div>
                    </div>
                @elseif($receipt->creditCardPayment)
                    <div class="grid grid-cols-3 gap-2 p-3 rounded-lg border text-gray-600 font-medium" style="background: #FBF3F5; border-color: #D9A99A;">
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Card Brand</span>{{ $receipt->creditCardPayment->card_brand }}</div>
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Last Four</span>**** {{ $receipt->creditCardPayment->card_last_four }}</div>
                        <div><span class="block text-3xs font-bold uppercase" style="color: #7A6B72;">Auth Code</span>{{ $receipt->creditCardPayment->authorization_code }}</div>
                    </div>
                @endif
            </div>

            <!-- Fee Breakdown Table -->
            <div class="p-6">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b text-2xs font-bold uppercase tracking-wider" style="color: #7A6B72; border-color: #D9A99A;">
                            <th class="py-2">Fee Item Description</th>
                            <th class="py-2 text-right">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y font-medium" style="color: #3A2E36; divide-color: #FBF3F5;">
                        <tr>
                            <td class="py-3">Tuition Fee</td>
                            <td class="py-3 text-right">
                                {{ number_format($receipt->transaction->studentAccount->student->feeStructure->tution_fee ?? 0, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3">Exam Fee</td>
                            <td class="py-3 text-right">
                                {{ number_format($receipt->transaction->studentAccount->student->feeStructure->exam_fee ?? 0, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3">Misc Fee</td>
                            <td class="py-3 text-right">
                                {{ number_format($receipt->transaction->studentAccount->student->feeStructure->misc_fee ?? 0, 2) }}
                            </td>
                        </tr>
                        @if($receipt->late_fine_levied > 0)
                            <tr>
                                <td class="py-3 font-semibold" style="color: #8B3A3A;">Late Fine Levied</td>
                                <td class="py-3 text-right font-semibold" style="color: #8B3A3A;">
                                    + {{ number_format($receipt->late_fine_levied, 2) }}
                                </td>
                            </tr>
                        @endif
                        <tr class="border-t font-bold" style="background: #FBF3F5; border-color: #D9A99A;">
                            <td class="py-3 px-2" style="color: #5C2A3E;">Total Paid Amount</td>
                            <td class="py-3 px-2 text-right text-base" style="color: #5C2A3E;">
                                Rs. {{ number_format($receipt->transaction->amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 text-center text-3xs font-semibold uppercase tracking-wider" style="background: #FBF3F5; border-top: 1px solid #D9A99A; color: #7A6B72;">
            This is a computer generated receipt &bull; Al-Noor School Fee Management System
        </div>
    </div>
</div>
@endsection
