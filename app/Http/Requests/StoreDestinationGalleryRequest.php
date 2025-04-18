<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationGalleryRequest extends FormRequest
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
            'destination' => 'required|string',
            'domestic_or_international' => 'required|in:domestic,international',
            'gallery_type' => 'required|in:resort,adventure,culture,activity,destination',
            'images_files.*' => 'required|image',
            'public_images' => 'nullable|in:private,public',
            'visibility' => 'required|in:private,public'
        ];
    }
}
