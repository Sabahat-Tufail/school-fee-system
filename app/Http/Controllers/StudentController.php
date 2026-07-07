<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\StudentAccount;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            
            $students = Student::with(['feeStructure', 'studentAccount'])
                ->when($search, function ($query, $search) {
                    return $query->where('first_name', 'like', "%{$search}%")
                                 ->orWhere('last_name', 'like', "%{$search}%");
                })
                ->paginate(10);

            $feeStructures = FeeStructure::all();

            return view('students.index', compact('students', 'feeStructures'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function create()
    {
        try {
            $feeStructures = FeeStructure::all();
            return view('students.create', compact('feeStructures'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            $student = Student::create($validated);

            $feeStructure = FeeStructure::findOrFail($validated['structure_id']);

            $totalFee = $feeStructure->tution_fee + $feeStructure->exam_fee + $feeStructure->misc_fee;

            StudentAccount::create([
                'student_id' => $student->id,
                'total_fee_due' => $totalFee,
                'total_concession_applied' => 0,
                'levied_fines' => 0,
                'total_payment_collected' => 0,
            ]);

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Student and account created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function show(Student $student)
    {
        try {
            $student->load(['feeStructure', 'studentAccount.transactions.paymentReceipt']);
            return view('students.show', compact('student'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit(Student $student)
    {
        try {
            $feeStructures = FeeStructure::all();
            return view('students.edit', compact('student', 'feeStructures'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $validated = $request->validated();
            $student->update($validated);

            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
