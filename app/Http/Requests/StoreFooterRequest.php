<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFooterRequest extends FormRequest
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
            'visibility' => 'required|in:public,private',
            'footer_column' => 'required|array',
            'footer_column.heading' => 'required|string|max:255',
            'footer_column.values' => 'required|array',
            'footer_column.values.*' => 'string|max:255',
        ];
    }
}
