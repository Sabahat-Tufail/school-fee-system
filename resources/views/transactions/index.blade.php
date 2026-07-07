@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="space-y-6">
    <!-- Top Bar with filters and button -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-white p-6 rounded-2xl" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <!-- Filter Chips -->
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('transactions.index') }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
               style="
                  @if(!$filterType)
                      background: #5C2A3E; border-color: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);
                  @else
                      border-color: #D9A99A; color: #7A6B72; background: #fff;
                  @endif
               ">
                All Transactions
            </a>
            <a href="{{ route('transactions.index', ['type' => 'payment']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
               style="
                  @if($filterType === 'payment')
                      background: #5C2A3E; border-color: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);
                  @else
                      border-color: #D9A99A; color: #7A6B72; background: #fff;
                  @endif
               ">
                Payments
            </a>
            <a href="{{ route('transactions.index', ['type' => 'concession']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
               style="
                  @if($filterType === 'concession')
                      background: #5C2A3E; border-color: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);
                  @else
                      border-color: #D9A99A; color: #7A6B72; background: #fff;
                  @endif
               ">
                Concessions
            </a>
            <a href="{{ route('transactions.index', ['type' => 'fine']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
               style="
                  @if($filterType === 'fine')
                      background: #5C2A3E; border-color: #5C2A3E; color: #fff; box-shadow: 0 4px 14px rgba(92,42,62,0.25);
                  @else
                      border-color: #D9A99A; color: #7A6B72; background: #fff;
                  @endif
               ">
                Fines
            </a>
        </div>

        <button type="button" onclick="openModal()"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
                style="background: #5C2A3E; color: #fff;">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>New Transaction</span>
        </button>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-2xl overflow-hidden" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider" style="background: #FBF3F5; color: #7A6B72; border-bottom: 1px solid #D9A99A;">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4">Class</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Receipt</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($transactions as $transaction)
                        <tr class="border-b transition-colors hover:bg-rose-50/30" style="border-color: #FBF3F5;">
                            <td class="px-6 py-4 font-bold" style="color: #7A6B72;">
                                #{{ $transaction->id }}
                            </td>
                            <td class="px-6 py-4 font-semibold" style="color: #3A2E36;">
                                {{ $transaction->studentAccount->student->first_name ?? 'N/A' }} {{ $transaction->studentAccount->student->last_name ?? '' }}
                            </td>
                            <td class="px-6 py-4" style="color: #7A6B72;">
                                {{ $transaction->studentAccount->student->feeStructure->class_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->transaction_type === 'payment')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #EEF7EE; color: #4A7A45; border: 1px solid #A9C9A4;">
                                        Payment
                                    </span>
                                @elseif($transaction->transaction_type === 'concession')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FDF0F5; color: #5C2A3E; border: 1px solid #C98A9E;">
                                        Concession
                                    </span>
                                @elseif($transaction->transaction_type === 'fine')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FFF0F0; color: #8B3A3A; border: 1px solid #F4A0A0;">
                                        Fine
                                    </span>
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
                            <td class="px-6 py-4 text-right">
                                @if($transaction->paymentReceipt)
                                    <a href="{{ route('receipts.show', $transaction->paymentReceipt->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                       style="color: #5C2A3E;"
                                       onmouseover="this.style.background='#FBF3F5';"
                                       onmouseout="this.style.background='transparent';">
                                        View Receipt
                                    </a>
                                @else
                                    <span class="text-xs font-medium" style="color: #7A6B72;">No Receipt</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center font-medium" style="color: #7A6B72;">
                                No transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="px-6 py-4" style="border-top: 1px solid #D9A99A; background: #FBF3F5;">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<!-- TRANSACTION MODAL -->
<div id="transaction-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-950/40" onclick="closeModal()"></div>
    
    <!-- Modal Panel -->
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-lg overflow-hidden mx-4" style="border: 1px solid #D9A99A;">
        <!-- Modal Header -->
        <div class="px-6 py-4 flex items-center justify-between" style="background: #FBF3F5; border-bottom: 1px solid #D9A99A;">
            <h4 class="font-bold" style="color: #3A2E36;">New Transaction</h4>
            <button type="button" onclick="closeModal()" style="color: #7A6B72;" class="hover:text-gray-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Unified Form -->
        <form method="POST" action="{{ route('transactions.store') }}" class="p-6">
            @csrf

            <!-- STEP 1: TRANSACTION DETAILS -->
            <div id="step1" class="space-y-5">
                <div class="flex justify-between items-center text-xs font-bold uppercase tracking-wider" style="color: #7A6B72;">
                    <span>Step 1 of 2</span>
                    <span>Details</span>
                </div>

                <!-- Select Student -->
                <div>
                    <label for="student_id" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Student</label>
                    <select name="student_id" id="student_id" required
                            class="block w-full rounded-xl py-2 px-3 text-sm animate-none"
                            style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        <option value="" disabled selected>Choose Student...</option>
                        @foreach($students as $st)
                            <option value="{{ $st->id }}" {{ old('student_id') == $st->id ? 'selected' : '' }}>
                                {{ $st->first_name }} {{ $st->last_name }} - {{ $st->feeStructure->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Transaction Type Card Selector -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2" style="color: #7A6B72;">Transaction Type</label>
                    <div class="grid grid-cols-3 gap-3">
                        <!-- Payment -->
                        <label id="card-payment" class="relative flex flex-col items-center justify-center p-4 bg-white border rounded-xl cursor-pointer transition-all select-none hover:border-emerald-500">
                            <input type="radio" name="transaction_type" value="payment" required onchange="handleTypeChange()" class="sr-only">
                            <span class="text-sm font-bold" style="color: #3A2E36;">Payment</span>
                        </label>
                        <!-- Concession -->
                        <label id="card-concession" class="relative flex flex-col items-center justify-center p-4 bg-white border rounded-xl cursor-pointer transition-all select-none hover:border-pink-400">
                            <input type="radio" name="transaction_type" value="concession" required onchange="handleTypeChange()" class="sr-only">
                            <span class="text-sm font-bold" style="color: #3A2E36;">Concession</span>
                        </label>
                        <!-- Fine -->
                        <label id="card-fine" class="relative flex flex-col items-center justify-center p-4 bg-white border rounded-xl cursor-pointer transition-all select-none hover:border-rose-400">
                            <input type="radio" name="transaction_type" value="fine" required onchange="handleTypeChange()" class="sr-only">
                            <span class="text-sm font-bold" style="color: #3A2E36;">Fine</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Amount</label>
                        <input type="number" name="amount" id="amount" min="0.01" step="0.01" required value="{{ old('amount') }}" placeholder="Rs. 0.00"
                               class="block w-full rounded-xl py-2 px-3 text-sm"
                               style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                    </div>
                    <!-- Date -->
                    <div>
                        <label for="transaction_date" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Transaction Date</label>
                        <input type="date" name="transaction_date" id="transaction_date" required value="{{ old('transaction_date', date('Y-m-d')) }}"
                               class="block w-full rounded-xl py-2 px-3 text-sm"
                               style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Category</label>
                    <input type="text" name="category" id="category" required value="{{ old('category') }}" placeholder="e.g. Tuition Fee, Exam Fee Fine"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <div class="flex justify-end pt-4" style="border-top: 1px solid #D9A99A;">
                    <button type="button" onclick="goToStep2()"
                            class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition-colors"
                            style="background: #5C2A3E;">
                        Next &rarr;
                    </button>
                </div>
            </div>

            <!-- STEP 2: PAYMENT & EXTRA DETAILS -->
            <div id="step2" class="space-y-5 hidden">
                <div class="flex justify-between items-center text-xs font-bold uppercase tracking-wider" style="color: #7A6B72;">
                    <span>Step 2 of 2</span>
                    <span>Payment &amp; Processing</span>
                </div>

                <!-- Late Fine input -->
                <div>
                    <label for="late_fine_levied" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Late Fine Levied (Optional)</label>
                    <input type="number" name="late_fine_levied" id="late_fine_levied" min="0" step="0.01" value="{{ old('late_fine_levied', 0) }}"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <!-- Concession Specific Fields -->
                <div id="concession-fields" class="hidden p-4 rounded-xl border space-y-4" style="background: #FBF3F5; border-color: #C98A9E;">
                    <h5 class="text-xs font-bold uppercase tracking-wide" style="color: #5C2A3E;">Concession Parameters</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="concession_type" class="block text-2xs font-bold uppercase mb-1" style="color: #5C2A3E;">Concession Type</label>
                            <input type="text" name="concession_type" id="concession_type" placeholder="e.g. Merit Scholarship"
                                   class="block w-full rounded-xl py-2 px-3 text-sm bg-white"
                                   style="border: 1.5px solid #C98A9E; color: #3A2E36;">
                        </div>
                        <div>
                            <label for="percentage" class="block text-2xs font-bold uppercase mb-1" style="color: #5C2A3E;">Percentage (%)</label>
                            <input type="number" name="percentage" id="percentage" min="0" max="100" step="0.01" placeholder="e.g. 50"
                                   class="block w-full rounded-xl py-2 px-3 text-sm bg-white"
                                   style="border: 1.5px solid #C98A9E; color: #3A2E36;">
                        </div>
                    </div>
                    <div>
                        <label for="authorization_ref" class="block text-2xs font-bold uppercase mb-1" style="color: #5C2A3E;">Authorization Ref</label>
                        <input type="text" name="authorization_ref" id="authorization_ref" placeholder="Reference code..."
                               class="block w-full rounded-xl py-2 px-3 text-sm bg-white"
                               style="border: 1.5px solid #C98A9E; color: #3A2E36;">
                    </div>
                </div>

                <!-- Payment Mode Selection Tabs -->
                <div>
                    <label class="block text-xs font-bold uppercase mb-2" style="color: #7A6B72;">Payment Mode</label>
                    <input type="hidden" name="payment_mode" id="payment_mode" value="cash">
                    
                    <div class="flex border rounded-xl overflow-hidden" style="background: #FBF3F5; border-color: #D9A99A;">
                        <button type="button" id="tab-cash" onclick="setPaymentMode('cash')"
                                class="flex-1 py-2 text-xs font-bold transition-all border-r bg-white shadow-sm"
                                style="color: #5C2A3E; border-color: #D9A99A;">
                            Cash
                        </button>
                        <button type="button" id="tab-online" onclick="setPaymentMode('online')"
                                class="flex-1 py-2 text-xs font-bold transition-all border-r"
                                style="color: #7A6B72; border-color: #D9A99A;">
                            Online
                        </button>
                        <button type="button" id="tab-credit_card" onclick="setPaymentMode('credit_card')"
                                class="flex-1 py-2 text-xs font-bold transition-all"
                                style="color: #7A6B72;">
                            Credit Card
                        </button>
                    </div>
                </div>

                <!-- Cash Payment Fields -->
                <div id="mode-fields-cash" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="window_number" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Window Number</label>
                            <input type="text" name="window_number" id="window_number" placeholder="e.g. Window 3"
                                   class="block w-full rounded-xl py-2 px-3 text-sm"
                                   style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        </div>
                        <div>
                            <label for="book_reference" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Book Reference</label>
                            <input type="text" name="book_reference" id="book_reference" placeholder="e.g. Book B10"
                                   class="block w-full rounded-xl py-2 px-3 text-sm"
                                   style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        </div>
                    </div>
                    <div>
                        <label for="cashier_name" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Cashier Name</label>
                        <input type="text" name="cashier_name" id="cashier_name" placeholder="Name..."
                               class="block w-full rounded-xl py-2 px-3 text-sm"
                               style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                    </div>
                </div>

                <!-- Online Payment Fields -->
                <div id="mode-fields-online" class="space-y-4 hidden">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="bank_name" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" placeholder="Bank name..."
                                   class="block w-full rounded-xl py-2 px-3 text-sm"
                                   style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        </div>
                        <div>
                            <label for="bank_reference_number" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Reference Number</label>
                            <input type="text" name="bank_reference_number" id="bank_reference_number" placeholder="Txn ref id..."
                                   class="block w-full rounded-xl py-2 px-3 text-sm"
                                   style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        </div>
                    </div>
                    <div>
                        <label for="iban" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">IBAN</label>
                        <input type="text" name="iban" id="iban" placeholder="International Bank Account No..."
                               class="block w-full rounded-xl py-2 px-3 text-sm"
                               style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                    </div>
                </div>

                <!-- Credit Card Payment Fields -->
                <div id="mode-fields-credit_card" class="space-y-4 hidden">
                    <div class="grid grid-cols-3 gap-3">
                        <div class="col-span-2">
                            <label for="authorization_code" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Auth Code</label>
                            <input type="text" name="authorization_code" id="authorization_code" placeholder="Auth code..."
                                   class="block w-full rounded-xl py-2 px-3 text-sm"
                                   style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        </div>
                        <div>
                            <label for="card_brand" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Brand</label>
                            <select name="card_brand" id="card_brand"
                                    class="block w-full rounded-xl py-2 px-3 text-sm"
                                    style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Amex">Amex</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="card_last_four" class="block text-2xs font-bold uppercase mb-1" style="color: #7A6B72;">Last 4 Digits</label>
                        <input type="text" name="card_last_four" id="card_last_four" maxlength="4" placeholder="e.g. 4321"
                               class="block w-full rounded-xl py-2 px-3 text-sm"
                               style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex items-center justify-between pt-4" style="border-top: 1px solid #D9A99A;">
                    <button type="button" onclick="goToStep1()"
                            class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-colors border"
                            style="border-color: #D9A99A; background: #fff; color: #7A6B72;"
                            onmouseover="this.style.background='#FBF3F5';"
                            onmouseout="this.style.background='#fff';">
                        &larr; Back
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white" style="background: #5C2A3E;">
                        Save Transaction
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('open_modal')) {
            openModal();
        }
    });

    function openModal() {
        document.getElementById('transaction-modal').classList.remove('hidden');
        goToStep1();
    }

    function closeModal() {
        document.getElementById('transaction-modal').classList.add('hidden');
    }

    function goToStep1() {
        document.getElementById('step1').classList.remove('hidden');
        document.getElementById('step2').classList.add('hidden');
    }

    function goToStep2() {
        const student = document.getElementById('student_id').value;
        const type = document.querySelector('input[name="transaction_type"]:checked');
        const amount = document.getElementById('amount').value;
        const cat = document.getElementById('category').value;

        if (!student || !type || !amount || !cat) {
            alert('Please fill out all Step 1 fields before proceeding.');
            return;
        }

        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');
    }

    function handleTypeChange() {
        const typeInput = document.querySelector('input[name="transaction_type"]:checked');
        
        ['payment', 'concession', 'fine'].forEach(t => {
            const label = document.getElementById(`card-${t}`);
            label.style.borderColor = '#E8D5E0';
            label.style.background = '#ffffff';
            
            if (typeInput && typeInput.value === t) {
                if (t === 'payment') {
                    label.style.borderColor = '#A9C9A4';
                    label.style.background = '#EEF7EE';
                } else if (t === 'concession') {
                    label.style.borderColor = '#F2C6D8';
                    label.style.background = '#FDF0F5';
                } else if (t === 'fine') {
                    label.style.borderColor = '#F4A0A0';
                    label.style.background = '#FFF0F0';
                }
            }
        });

        const concessionBlock = document.getElementById('concession-fields');
        if (typeInput && typeInput.value === 'concession') {
            concessionBlock.classList.remove('hidden');
        } else {
            concessionBlock.classList.add('hidden');
        }
    }

    function setPaymentMode(mode) {
        document.getElementById('payment_mode').value = mode;

        ['cash', 'online', 'credit_card'].forEach(m => {
            const tabBtn = document.getElementById(`tab-${m}`);
            const fieldsDiv = document.getElementById(`mode-fields-${m}`);

            tabBtn.style.background = 'transparent';
            tabBtn.style.color = '#7A6B72';
            tabBtn.style.boxShadow = 'none';
            fieldsDiv.classList.add('hidden');

            if (m === mode) {
                tabBtn.style.background = '#ffffff';
                tabBtn.style.color = '#7D5A75';
                tabBtn.style.boxShadow = '0 1px 3px rgba(0,0,0,0.05)';
                fieldsDiv.classList.remove('hidden');
            }
        });
    }
</script>
@endsection
