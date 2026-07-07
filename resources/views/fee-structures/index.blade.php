@extends('layouts.app')

@section('title', 'Fee Structures')

@section('content')
<div class="space-y-6">
    <!-- Top Bar -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <h3 class="text-lg font-bold" style="color: #3A2E36;">Fee Structures</h3>
        <button type="button" onclick="openAddModal()"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
                style="background: #5C2A3E; color: #fff;">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Add Fee Structure</span>
        </button>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($feeStructures as $fs)
            <div class="bg-white rounded-2xl overflow-hidden flex flex-col justify-between" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
                <div class="p-6">
                    <!-- Badges Header -->
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold" style="background: #FBF3F5; color: #5C2A3E; border: 1px solid #C98A9E;">
                            {{ $fs->class_name }}
                        </span>
                        <span class="text-xs font-bold" style="color: #7A6B72;">Section {{ $fs->section }}</span>
                    </div>

                    <div class="mb-4">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-2xs font-semibold" style="background: #FBF3F5; color: #7A6B72; border: 1px solid #D9A99A;">
                            {{ $fs->term }}
                        </span>
                    </div>

                    <!-- Fee Breakdown -->
                    <div class="space-y-2 text-sm" style="color: #7A6B72;">
                        <div class="flex justify-between">
                            <span>Tuition Fee</span>
                            <span class="font-semibold" style="color: #3A2E36;">Rs. {{ number_format($fs->tution_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Exam Fee</span>
                            <span class="font-semibold" style="color: #3A2E36;">Rs. {{ number_format($fs->exam_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Misc Fee</span>
                            <span class="font-semibold" style="color: #3A2E36;">Rs. {{ number_format($fs->misc_fee, 2) }}</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="my-4" style="border-top: 1px solid #FBF3F5;"></div>

                    <!-- Total -->
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-semibold" style="color: #7A6B72;">Total Fee</span>
                        <span class="text-base font-bold" style="color: #5C2A3E;">
                            Rs. {{ number_format($fs->tution_fee + $fs->exam_fee + $fs->misc_fee, 2) }}
                        </span>
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="px-6 py-4 bg-gray-50 flex items-center justify-end gap-3" style="background: #FBF3F5; border-top: 1px solid #D9A99A;">
                    <button type="button" onclick="openEditModal('{{ $fs->id }}', '{{ $fs->class_name }}', '{{ $fs->section }}', '{{ $fs->term }}', '{{ $fs->tution_fee }}', '{{ $fs->exam_fee }}', '{{ $fs->misc_fee }}')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                            style="color: #5C2A3E;"
                            onmouseover="this.style.background='#FBF3F5';"
                            onmouseout="this.style.background='transparent';">
                        Edit
                    </button>

                    <form method="POST" action="{{ route('fee-structures.destroy', $fs->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this fee structure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                style="color: #8B3A3A;"
                                onmouseover="this.style.background='#FFF0F0';"
                                onmouseout="this.style.background='transparent';">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-12 text-center font-medium" style="border: 1px solid #D9A99A; color: #7A6B72; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
                No fee structures registered yet.
            </div>
        @endforelse
    </div>
</div>

<!-- ADD FEE STRUCTURE MODAL -->
<div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-950/40" onclick="closeAddModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-lg border overflow-hidden mx-4" style="border-color: #D9A99A;">
        <div class="px-6 py-4 flex items-center justify-between" style="background: #FBF3F5; border-bottom: 1px solid #D9A99A;">
            <h4 class="font-bold" style="color: #3A2E36;">Add Fee Structure</h4>
            <button type="button" onclick="closeAddModal()" style="color: #7A6B72;" class="hover:text-gray-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('fee-structures.store') }}" class="p-6 space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="add_class_name" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Class Name</label>
                    <select name="class_name" id="add_class_name" required
                            class="block w-full rounded-xl py-2 px-3 text-sm"
                            style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        @foreach(['Pre-Nursery','Nursery','Prep','Class 1','Class 2','Class 3','Class 4','Class 5','Class 6','Class 7','Class 8','Class 9','Class 10','Class 1-5','Class 6-10'] as $cls)
                            <option value="{{ $cls }}">{{ $cls }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="add_section" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Section</label>
                    <select name="section" id="add_section" required
                            class="block w-full rounded-xl py-2 px-3 text-sm"
                            style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        @foreach(['A','B','C'] as $sec)
                            <option value="{{ $sec }}">{{ $sec }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="add_term" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Term</label>
                <input type="text" name="term" id="add_term" placeholder="e.g. Spring 2024" required
                       class="block w-full rounded-xl py-2 px-3 text-sm"
                       style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;"
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label for="add_tution_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Tuition Fee</label>
                    <input type="number" name="tution_fee" id="add_tution_fee" min="0" step="0.01" required value="0" oninput="calculateAddTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <div>
                    <label for="add_exam_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Exam Fee</label>
                    <input type="number" name="exam_fee" id="add_exam_fee" min="0" step="0.01" required value="0" oninput="calculateAddTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <div>
                    <label for="add_misc_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Misc Fee</label>
                    <input type="number" name="misc_fee" id="add_misc_fee" min="0" step="0.01" required value="0" oninput="calculateAddTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>
            </div>

            <!-- Live Total -->
            <div class="rounded-xl p-4 flex items-center justify-between" style="background: #FBF3F5; border: 1px solid #C98A9E;">
                <span class="text-xs font-bold uppercase" style="color: #5C2A3E;">Live Total:</span>
                <span id="add-live-total" class="text-base font-bold" style="color: #5C2A3E;">Rs. 0.00</span>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4" style="border-top: 1px solid #D9A99A;">
                <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 rounded-xl font-semibold text-sm transition-colors"
                        style="border: 1.5px solid #D9A99A; background: #fff; color: #7A6B72;"
                        onmouseover="this.style.background='#FBF3F5';"
                        onmouseout="this.style.background='#fff';">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-xl font-semibold text-sm text-white" style="background: #5C2A3E;">Save Structure</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT FEE STRUCTURE MODAL -->
<div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-950/40" onclick="closeEditModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-lg border overflow-hidden mx-4" style="border-color: #D9A99A;">
        <div class="px-6 py-4 flex items-center justify-between" style="background: #FBF3F5; border-bottom: 1px solid #D9A99A;">
            <h4 class="font-bold" style="color: #3A2E36;">Edit Fee Structure</h4>
            <button type="button" onclick="closeEditModal()" style="color: #7A6B72;" class="hover:text-gray-900">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-form" method="POST" action="" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edit_class_name" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Class Name</label>
                    <select name="class_name" id="edit_class_name" required
                            class="block w-full rounded-xl py-2 px-3 text-sm"
                            style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        @foreach(['Pre-Nursery','Nursery','Prep','Class 1','Class 2','Class 3','Class 4','Class 5','Class 6','Class 7','Class 8','Class 9','Class 10','Class 1-5','Class 6-10'] as $cls)
                            <option value="{{ $cls }}">{{ $cls }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="edit_section" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Section</label>
                    <select name="section" id="edit_section" required
                            class="block w-full rounded-xl py-2 px-3 text-sm"
                            style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                        @foreach(['A','B','C'] as $sec)
                            <option value="{{ $sec }}">{{ $sec }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="edit_term" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Term</label>
                <input type="text" name="term" id="edit_term" required
                       class="block w-full rounded-xl py-2 px-3 text-sm"
                       style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;"
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label for="edit_tution_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Tuition Fee</label>
                    <input type="number" name="tution_fee" id="edit_tution_fee" min="0" step="0.01" required oninput="calculateEditTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <div>
                    <label for="edit_exam_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Exam Fee</label>
                    <input type="number" name="exam_fee" id="edit_exam_fee" min="0" step="0.01" required oninput="calculateEditTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>

                <div>
                    <label for="edit_misc_fee" class="block text-xs font-bold uppercase mb-1" style="color: #7A6B72;">Misc Fee</label>
                    <input type="number" name="misc_fee" id="edit_misc_fee" min="0" step="0.01" required oninput="calculateEditTotal()"
                           class="block w-full rounded-xl py-2 px-3 text-sm"
                           style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36;">
                </div>
            </div>

            <!-- Live Total -->
            <div class="rounded-xl p-4 flex items-center justify-between" style="background: #FBF3F5; border: 1px solid #C98A9E;">
                <span class="text-xs font-bold uppercase" style="color: #5C2A3E;">Live Total:</span>
                <span id="edit-live-total" class="text-base font-bold" style="color: #5C2A3E;">Rs. 0.00</span>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4" style="border-top: 1px solid #D9A99A;">
                <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 rounded-xl font-semibold text-sm transition-colors"
                        style="border: 1.5px solid #D9A99A; background: #fff; color: #7A6B72;"
                        onmouseover="this.style.background='#FBF3F5';"
                        onmouseout="this.style.background='#fff';">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-xl font-semibold text-sm text-white" style="background: #5C2A3E;">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openAddModal() {
        document.getElementById('add-modal').classList.remove('hidden');
        calculateAddTotal();
    }

    function closeAddModal() {
        document.getElementById('add-modal').classList.add('hidden');
    }

    function openEditModal(id, className, section, term, tutionFee, examFee, miscFee) {
        const form = document.getElementById('edit-form');
        form.action = `/fee-structures/${id}`;
        
        document.getElementById('edit_class_name').value = className;
        document.getElementById('edit_section').value = section;
        document.getElementById('edit_term').value = term;
        document.getElementById('edit_tution_fee').value = parseFloat(tutionFee);
        document.getElementById('edit_exam_fee').value = parseFloat(examFee);
        document.getElementById('edit_misc_fee').value = parseFloat(miscFee);
        
        document.getElementById('edit-modal').classList.remove('hidden');
        calculateEditTotal();
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    function calculateAddTotal() {
        const tution = parseFloat(document.getElementById('add_tution_fee').value) || 0;
        const exam = parseFloat(document.getElementById('add_exam_fee').value) || 0;
        const misc = parseFloat(document.getElementById('add_misc_fee').value) || 0;
        const total = tution + exam + misc;
        document.getElementById('add-live-total').textContent = 'Rs. ' + total.toFixed(2);
    }

    function calculateEditTotal() {
        const tution = parseFloat(document.getElementById('edit_tution_fee').value) || 0;
        const exam = parseFloat(document.getElementById('edit_exam_fee').value) || 0;
        const misc = parseFloat(document.getElementById('edit_misc_fee').value) || 0;
        const total = tution + exam + misc;
        document.getElementById('edit-live-total').textContent = 'Rs. ' + total.toFixed(2);
    }
</script>
@endsection
