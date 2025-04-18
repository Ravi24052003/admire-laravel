<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDestinationGalleryRequest extends FormRequest
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
            'destination' => 'sometimes|string',
            'domestic_or_international' => 'sometimes|in:domestic,international',
            'gallery_type' => 'nullable|in:resort,adventure,culture,activity,destination',
            'removed_images' => 'nullable|string',
            'public_images' => 'nullable|string',
            'images_files.*' => 'sometimes|image',
            'visibility' => 'sometimes|in:private,public'
        ];
    }
}
