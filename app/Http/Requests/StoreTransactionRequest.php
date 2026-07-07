<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            // Core transaction fields
            'student_id'           => ['required', 'exists:students,id'],
            'transaction_type'     => ['required', 'in:payment,concession,fine'],
            'transaction_date'     => ['required', 'date'],
            'amount'               => ['required', 'numeric', 'min:0.01'],
            'category'             => ['required', 'string', 'max:100'],

            // Receipt fields
            'payment_mode'         => ['required', 'in:cash,online,credit_card'],
            'late_fine_levied'     => ['nullable', 'numeric', 'min:0'],

            // Cash payment fields
            'window_number'        => ['required_if:payment_mode,cash', 'nullable', 'string'],
            'book_reference'       => ['required_if:payment_mode,cash', 'nullable', 'string'],
            'cashier_name'         => ['required_if:payment_mode,cash', 'nullable', 'string'],

            // Online payment fields
            'bank_name'            => ['required_if:payment_mode,online', 'nullable', 'string'],
            'iban'                 => ['required_if:payment_mode,online', 'nullable', 'string'],
            'bank_reference_number'=> ['required_if:payment_mode,online', 'nullable', 'string'],

            // Credit card payment fields
            'authorization_code'   => ['required_if:payment_mode,credit_card', 'nullable', 'string'],
            'card_brand'           => ['required_if:payment_mode,credit_card', 'nullable', 'in:Visa,Mastercard,Amex'],
            'card_last_four'       => ['required_if:payment_mode,credit_card', 'nullable', 'digits:4'],

            // Concession fields
            'concession_type'      => ['required_if:transaction_type,concession', 'nullable', 'string'],
            'percentage'           => ['required_if:transaction_type,concession', 'nullable', 'numeric', 'min:0', 'max:100'],
            'authorization_ref'    => ['required_if:transaction_type,concession', 'nullable', 'string'],
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
            'student_id.required'            => 'Please select a student.',
            'student_id.exists'              => 'The selected student does not exist.',
            'transaction_type.required'      => 'Transaction type is required.',
            'transaction_type.in'            => 'Transaction type must be payment, concession, or fine.',
            'transaction_date.required'      => 'Transaction date is required.',
            'amount.required'                => 'Amount is required.',
            'amount.min'                     => 'Amount must be greater than zero.',
            'category.required'              => 'Category is required.',
            'payment_mode.required'          => 'Payment mode is required.',
            'payment_mode.in'                => 'Payment mode must be cash, online, or credit card.',
            'window_number.required_if'      => 'Window number is required for cash payments.',
            'book_reference.required_if'     => 'Book reference is required for cash payments.',
            'cashier_name.required_if'       => 'Cashier name is required for cash payments.',
            'bank_name.required_if'          => 'Bank name is required for online payments.',
            'iban.required_if'               => 'IBAN is required for online payments.',
            'bank_reference_number.required_if' => 'Bank reference number is required for online payments.',
            'authorization_code.required_if' => 'Authorization code is required for credit card payments.',
            'card_brand.required_if'         => 'Card brand is required for credit card payments.',
            'card_brand.in'                  => 'Card brand must be Visa, Mastercard, or Amex.',
            'card_last_four.required_if'     => 'Last four digits of the card are required for credit card payments.',
            'card_last_four.digits'          => 'Card last four must be exactly 4 digits.',
            'concession_type.required_if'    => 'Concession type is required for concession transactions.',
            'percentage.required_if'         => 'Percentage is required for concession transactions.',
            'percentage.min'                 => 'Percentage cannot be negative.',
            'percentage.max'                 => 'Percentage cannot exceed 100.',
            'authorization_ref.required_if'  => 'Authorization reference is required for concession transactions.',
        ];
    }
}
