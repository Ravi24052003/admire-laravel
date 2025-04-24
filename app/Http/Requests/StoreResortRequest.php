<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResortRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'images' => "nullable",
             'images_files.*' => 'required|image',
            'visibility' => 'required|in:private,public',
            'discount' => 'nullable|string|max:50',
             'public_images' => 'nullable|in:private,public'
        ];
    }
}
