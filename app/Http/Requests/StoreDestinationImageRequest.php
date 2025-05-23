<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationImageRequest extends FormRequest
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
            'destination' => 'required|string|unique:destination_images,destination',
            "domestic_or_international" => "required|in:domestic,international",
            'images' => "nullable",
             'images_files.*' => 'required|image',
             'destination_type' => 'required',
             'public_images' => 'nullable|in:private,public'
        ];
    }
}
