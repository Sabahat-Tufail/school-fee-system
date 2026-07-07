@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl overflow-hidden" style="border: 1px solid #F2D5E0; box-shadow: 0 4px 20px rgba(92,64,86,0.10);">
        <div class="px-6 py-5" style="border-bottom: 1px solid #F2D5E0; background: #FBF3F5;">
            <h3 class="text-lg font-bold" style="color: #3A2E36;">Add New Student</h3>
            <p class="text-xs mt-1" style="color: #7A6B72;">Register a student and automatically create their fee account.</p>
        </div>

        <form method="POST" action="{{ route('students.store') }}" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                           class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('first_name') border-red-300 @enderror"
                           style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                           placeholder="Sara"
                           onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                           onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                    @error('first_name')
                        <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                           class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('last_name') border-red-300 @enderror"
                           style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                           placeholder="Ahmed"
                           onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                           onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                    @error('last_name')
                        <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Roll Number -->
            <div>
                <label for="roll_number" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">Roll Number</label>
                <input type="text" name="roll_number" id="roll_number" value="{{ old('roll_number') }}"
                       class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('roll_number') border-red-300 @enderror"
                       style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                       placeholder="e.g. 001"
                       onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                       onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                <p class="mt-1 text-xs" style="color: #7A6B72;">Used to link a student account to their fee record.</p>
                @error('roll_number')
                    <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                           class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('date_of_birth') border-red-300 @enderror"
                           style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                           onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                           onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                    @error('date_of_birth')
                        <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Admission Date -->
                <div>
                    <label for="admission_date" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">Admission Date</label>
                    <input type="date" name="admission_date" id="admission_date" value="{{ old('admission_date') }}"
                           class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('admission_date') border-red-300 @enderror"
                           style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                           onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                           onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                    @error('admission_date')
                        <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fee Structure -->
            <div>
                <label for="structure_id" class="block text-sm font-semibold mb-2" style="color: #3A2E36;">Fee Structure Assignment</label>
                <select name="structure_id" id="structure_id"
                        class="block w-full rounded-xl py-2.5 px-3.5 text-sm @error('structure_id') border-red-300 @enderror"
                        style="border: 1.5px solid #E8D5E0; background: #FBF3F5; color: #3A2E36;"
                        onfocus="this.style.borderColor='#7D5A75'; this.style.boxShadow='0 0 0 3px rgba(125,90,117,0.12)';"
                        onblur="this.style.borderColor='#E8D5E0'; this.style.boxShadow='none';">
                    <option value="" disabled selected>Select fee structure...</option>
                    @foreach($feeStructures as $fs)
                        <option value="{{ $fs->id }}" {{ old('structure_id') == $fs->id ? 'selected' : '' }}>
                            {{ $fs->class_name }} - Section {{ $fs->section }} ({{ $fs->term }} - Tuition: Rs. {{ number_format($fs->tution_fee, 2) }})
                        </option>
                    @endforeach
                </select>
                @error('structure_id')
                    <p class="mt-1.5 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Footer Actions -->
            <div class="flex items-center justify-end gap-3 pt-4" style="border-top: 1px solid #F2D5E0;">
                <a href="{{ route('students.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-semibold text-sm transition-colors"
                   style="border: 1.5px solid #E8D5E0; color: #7A6B72; background: #fff;"
                   onmouseover="this.style.background='#FBF3F5';"
                   onmouseout="this.style.background='#fff';">
                    Back
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
                        style="background: #7D5A75; color: #fff;">
                    Save Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
