<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        try {
            $feeStructures = FeeStructure::all();
            return view('fee-structures.index', compact('feeStructures'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function store(StoreFeeStructureRequest $request)
    {
        try {
            $validated = $request->validated();
            FeeStructure::create($validated);

            return redirect()->route('fee-structures.index')->with('success', 'Fee structure created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        try {
            $validated = $request->validated();
            $feeStructure->update($validated);

            return redirect()->route('fee-structures.index')->with('success', 'Fee structure updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function destroy(FeeStructure $feeStructure)
    {
        try {
            // Check if any students are linked to this fee structure
            if ($feeStructure->students()->exists()) {
                return back()->with('error', 'Cannot delete — students are linked to this fee structure.');
            }

            $feeStructure->delete();

            return redirect()->route('fee-structures.index')->with('success', 'Fee structure deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
