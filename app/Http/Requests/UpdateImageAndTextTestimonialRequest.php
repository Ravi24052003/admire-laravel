<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageAndTextTestimonialRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'text' => 'required|string',
            'visibility' => 'required|in:private,public',
            'image_file' => 'sometimes|image|max:2048',
            'images' => 'nullable',
            'images_files.*' => 'nullable|image|max:2048'
        ];
    }
}
