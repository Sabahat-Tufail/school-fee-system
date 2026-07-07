@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="space-y-6">
    <!-- Top Bar -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-white p-6 rounded-2xl" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <div class="flex items-center gap-3">
            <h3 class="text-lg font-bold" style="color: #3A2E36;">Students</h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold" style="background: #FBF3F5; color: #5C2A3E; border: 1px solid #C98A9E;">
                {{ $students->total() }} Total
            </span>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <!-- Search Form -->
            <form method="GET" action="{{ route('students.index') }}" class="relative flex-1 sm:w-80">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5" style="color: #7A6B72;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
                       class="block w-full rounded-xl py-2.5 pl-10 pr-3 text-sm"
                       style="border: 1.5px solid #D9A99A; background: #FBF3F5; color: #3A2E36; outline: none;"
                       onfocus="this.style.borderColor='#5C2A3E'; this.style.boxShadow='0 0 0 3px rgba(92,42,62,0.12)';"
                       onblur="this.style.borderColor='#D9A99A'; this.style.boxShadow='none';">
            </form>

            <a href="{{ route('students.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition-all hover:-translate-y-0.5"
               style="background: #5C2A3E; color: #fff;">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Student</span>
            </a>
        </div>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-2xl overflow-hidden" style="border: 1px solid #D9A99A; box-shadow: 0 2px 10px rgba(92,42,62,0.07);">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider" style="background: #FBF3F5; color: #7A6B72; border-bottom: 1px solid #D9A99A;">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Roll No.</th>
                        <th class="px-6 py-4">Full Name</th>
                        <th class="px-6 py-4">Date of Birth</th>
                        <th class="px-6 py-4">Admission Date</th>
                        <th class="px-6 py-4">Fee Structure</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($students as $index => $student)
                        <tr class="border-b transition-colors hover:bg-rose-50/30" style="border-color: #FBF3F5;">
                            <td class="px-6 py-4 font-medium" style="color: #7A6B72;">
                                {{ ($students->currentPage() - 1) * $students->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                @if($student->roll_number)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold" style="background: #FBF3F5; color: #5C2A3E; border: 1px solid #C98A9E;">
                                        {{ $student->roll_number }}
                                    </span>
                                @else
                                    <span class="text-xs" style="color: #7A6B72;">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold" style="color: #3A2E36;">
                                {{ $student->first_name }} {{ $student->last_name }}
                            </td>
                            <td class="px-6 py-4" style="color: #7A6B72;">
                                {{ date('M d, Y', strtotime($student->date_of_birth)) }}
                            </td>
                            <td class="px-6 py-4" style="color: #7A6B72;">
                                {{ date('M d, Y', strtotime($student->admission_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold" style="background: #FBF3F5; color: #5C2A3E; border: 1px solid #C98A9E;">
                                    {{ $student->feeStructure->class_name }} - {{ $student->feeStructure->section }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('students.edit', $student->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                       style="color: #5C2A3E;"
                                       onmouseover="this.style.background='#FBF3F5'; this.style.borderColor='#C98A9E';"
                                       onmouseout="this.style.background='transparent'; this.style.borderColor='transparent';">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 20.013a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>

                                    <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this student and their associated account data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                                style="color: #8B3A3A;"
                                                onmouseover="this.style.background='#FFF0F0';"
                                                onmouseout="this.style.background='transparent';">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center font-medium" style="color: #7A6B72;">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div class="px-6 py-4" style="border-top: 1px solid #F2D5E0; background: #FBF3F5;">
                {{ $students->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
