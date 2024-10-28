<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Import the Rule class

class TourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow the request to proceed by returning true
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
            'priceFrom' => 'numeric|nullable', // Nullable so it doesn't require the field
            'priceTo' => 'numeric|nullable',
            'dateFrom' => 'date|nullable',
            'dateTo' => 'date|nullable',
            'sortBy' => ['nullable', Rule::in(['price'])], // Use Rule::in for validation
            'sortOrder' => ['nullable', Rule::in(['asc', 'desc'])] // Custom error message
       ,
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0',
        ];
    }
}