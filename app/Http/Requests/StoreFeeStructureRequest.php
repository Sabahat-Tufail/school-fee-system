<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeStructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class_name'  => [
                'required',
                'string',
                'in:Pre-Nursery,Nursery,Prep,Class 1,Class 2,Class 3,Class 4,Class 5,Class 6,Class 7,Class 8,Class 9,Class 10,Class 1-5,Class 6-10',
            ],
            'section'    => ['required', 'string', 'in:A,B,C'],
            'term'       => ['required', 'string', 'max:50'],
            'tution_fee' => ['required', 'numeric', 'min:0'],
            'exam_fee'   => ['required', 'numeric', 'min:0'],
            'misc_fee'   => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'class_name.required' => 'Class name is required.',
            'class_name.in'       => 'Please select a valid class.',
            'section.required'    => 'Section is required.',
            'section.in'          => 'Section must be A, B, or C.',
            'term.required'       => 'Term is required.',
            'tution_fee.required' => 'Tuition fee is required.',
            'tution_fee.numeric'  => 'Tuition fee must be a valid number.',
            'tution_fee.min'      => 'Tuition fee cannot be negative.',
            'exam_fee.required'   => 'Exam fee is required.',
            'exam_fee.numeric'    => 'Exam fee must be a valid number.',
            'exam_fee.min'        => 'Exam fee cannot be negative.',
            'misc_fee.required'   => 'Miscellaneous fee is required.',
            'misc_fee.numeric'    => 'Miscellaneous fee must be a valid number.',
            'misc_fee.min'        => 'Miscellaneous fee cannot be negative.',
        ];
    }
}
