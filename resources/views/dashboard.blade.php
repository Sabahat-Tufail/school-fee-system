@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card 1: Total Students -->
        <div class="flex items-center p-6 bg-white rounded-2xl border" style="border-color: #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
            <div class="p-3 mr-4 rounded-xl flex-shrink-0" style="background: #FBF3F5; color: #5C2A3E;">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 12 19.5a11.385 11.385 0 0 1-3-1.263v-.11M12 18.75V12m0 0V5.25m0 6.75h9.75M12 12H2.25M6.25 15.75a4.125 4.125 0 0 1 7.533-2.493A9.337 9.337 0 0 0 9.75 12c-2.31 0-4.425.836-6.075 2.228M6.25 15.75v-.003c0-1.113.285-2.16.786-3.07" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold" style="color: #3A2E36;">{{ $totalStudents }}</p>
                <p class="text-sm font-semibold" style="color: #7A6B72;">Total Students</p>
            </div>
        </div>

        <!-- Card 2: Fee Collected -->
        <div class="flex items-center p-6 bg-white rounded-2xl border" style="border-color: #A9C9A4; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
            <div class="p-3 mr-4 rounded-xl flex-shrink-0" style="background: #EEF7EE; color: #4A7A45;">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold" style="color: #3A2E36;">Rs. {{ number_format($totalCollected, 2) }}</p>
                <p class="text-sm font-semibold" style="color: #7A6B72;">Fee Collected</p>
            </div>
        </div>

        <!-- Card 3: Outstanding Balance -->
        <div class="flex items-center p-6 bg-white rounded-2xl border" style="border-color: #F4A0A0; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
            <div class="p-3 mr-4 rounded-xl flex-shrink-0" style="background: #FFF0F0; color: #8B3A3A;">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold" style="color: #3A2E36;">Rs. {{ number_format($totalOutstanding, 2) }}</p>
                <p class="text-sm font-semibold" style="color: #7A6B72;">Outstanding Balance</p>
            </div>
        </div>

        <!-- Card 4: Total Concessions -->
        <div class="flex items-center p-6 bg-white rounded-2xl border" style="border-color: #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
            <div class="p-3 mr-4 rounded-xl flex-shrink-0" style="background: #FBF3F5; color: #5C2A3E;">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0-2.625V7.5m0-2.625a2.625 2.625 0 1 1-2.625 2.625M12 7.5h8.25M12 7.5H3.75M12 7.5v13.5" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold" style="color: #3A2E36;">Rs. {{ number_format($totalConcessions, 2) }}</p>
                <p class="text-sm font-semibold" style="color: #7A6B72;">Total Concessions</p>
            </div>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('students.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
           style="background: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Add Student</span>
        </a>
        <a href="{{ route('transactions.index') }}?open_modal=1"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
           style="background: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>New Transaction</span>
        </a>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white rounded-2xl overflow-hidden" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <div class="flex items-center justify-between px-6 py-5" style="border-bottom: 1px solid #D9A99A;">
            <h3 class="text-lg font-bold" style="color: #3A2E36;">Recent Transactions</h3>
            <a href="{{ route('transactions.index') }}" class="text-sm font-bold hover:underline" style="color: #5C2A3E;">View All Transactions</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider" style="background: #FBF3F5; color: #7A6B72; border-bottom: 1px solid #D9A99A;">
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Date</th>
                    </tr>
                </thead>
                <tbody class="text-sm" style="divide-color: #D9A99A;">
                    @forelse($recentTransactions as $transaction)
                        <tr class="border-b transition-colors hover:bg-rose-50/30" style="border-color: #FBF3F5;">
                            <td class="px-6 py-4 font-semibold" style="color: #3A2E36;">
                                {{ $transaction->studentAccount->student->first_name ?? 'N/A' }} {{ $transaction->studentAccount->student->last_name ?? '' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->transaction_type === 'payment')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #EEF7EE; color: #4A7A45; border: 1px solid #A9C9A4;">Payment</span>
                                @elseif($transaction->transaction_type === 'concession')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FDF0F5; color: #5C2A3E; border: 1px solid #C98A9E;">Concession</span>
                                @elseif($transaction->transaction_type === 'fine')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FFF0F0; color: #8B3A3A; border: 1px solid #F4A0A0;">Fine</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold" style="color: #3A2E36;">
                                Rs. {{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4" style="color: #7A6B72;">
                                {{ $transaction->category }}
                            </td>
                            <td class="px-6 py-4" style="color: #7A6B72;">
                                {{ date('M d, Y', strtotime($transaction->transaction_date)) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center font-medium" style="color: #7A6B72;">
                                No transactions yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
