<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|integer|exists:customers,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:consultation,development,maintenance,support,training,other',
            'price' => 'required|numeric|min:0|max:999999.99',
            'status' => 'nullable|in:active,inactive,pending,completed',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
            'duration_hours' => 'nullable|integer|min:1|max:10000',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'notes' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer is required',
            'customer_id.exists' => 'Selected customer does not exist',
            'name.required' => 'Service name is required',
            'type.required' => 'Service type is required',
            'type.in' => 'Service type must be one of: consultation, development, maintenance, support, training, other',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a valid number',
            'price.min' => 'Price cannot be negative',
            'price.max' => 'Price cannot exceed $999,999.99',
            'status.in' => 'Status must be one of: active, inactive, pending, completed',
            'start_date.after_or_equal' => 'Start date must be today or later',
            'end_date.after' => 'End date must be after start date',
            'duration_hours.min' => 'Duration must be at least 1 hour',
            'duration_hours.max' => 'Duration cannot exceed 10,000 hours'
        ];
    }
}
