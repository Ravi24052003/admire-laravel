<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDestinationImageRequest extends FormRequest
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
            'destination' => 'sometimes|string|unique:destination_images,destination,'.$this->route("destination_image")->id,
            'removed_images' => "nullable|string",
            'public_images' => "nullable|string",
            "domestic_or_international" => "sometimes|in:domestic,international",
            'images' => "nullable",
            'images_files.*' => 'sometimes|image',
        ];
    }
}
