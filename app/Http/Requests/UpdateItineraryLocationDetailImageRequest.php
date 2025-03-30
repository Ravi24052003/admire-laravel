<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItineraryLocationDetailImageRequest extends FormRequest
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
            'destination' => 'sometimes|string|unique:itinerary_location_detail_images,destination,'.$this->route("itinerary_location_detail_image")->id,
            'removed_images' => "nullable|string",
            'images' => "nullable",
             'images_files.*' => 'sometimes|image|max:2048'
        ];
    }
}
