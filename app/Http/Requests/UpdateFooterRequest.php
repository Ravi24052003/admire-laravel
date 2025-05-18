<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterRequest extends FormRequest
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
            'visibility' => 'sometimes|in:public,private',
            'footer_column' => 'sometimes|array',
            'footer_column.heading' => 'sometimes|string|max:255',
            'footer_column.values' => 'sometimes|array',
            'footer_column.values.*' => 'string|max:255',
        ];
    }
}
