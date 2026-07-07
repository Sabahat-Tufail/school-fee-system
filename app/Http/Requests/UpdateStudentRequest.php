<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'date_of_birth'  => ['required', 'date', 'before:today'],
            'admission_date' => ['required', 'date'],
            'structure_id'   => ['required', 'exists:fee_structures,id'],
            'roll_number' => ['required', 'string', 'max:50', 'unique:students,roll_number,' . $this->student->id],
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
            'first_name.required'     => 'First name is required.',
            'last_name.required'      => 'Last name is required.',
            'date_of_birth.required'  => 'Date of birth is required.',
            'date_of_birth.before'    => 'Date of birth must be before today.',
            'admission_date.required' => 'Admission date is required.',
            'structure_id.required'   => 'Please select a fee structure.',
            'structure_id.exists'     => 'The selected fee structure does not exist.',
        ];
    }
}
