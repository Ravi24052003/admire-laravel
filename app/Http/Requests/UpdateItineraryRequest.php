<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItineraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Ensure proper authorization logic if required
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'domestic_or_international' => 'sometimes|in:domestic,international',
            'days_information_string' => 'sometimes|string',
            'destination_detail' => 'sometimes|string',
            'inclusion' => 'nullable|string',
            'exclusion' => 'nullable|string',
            'additional_inclusion' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'special_note' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'payment_mode' => 'nullable|string',

            'pricing' => 'nullable|string|max:255',
            'hotel_details_string' => 'sometimes|string',
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:itineraries,slug,' . $this->route('itinerary')->id,
            'meta_title' => 'nullable|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'itinerary_visibility' => 'sometimes|string|max:255',
            'itinerary_type' => 'sometimes|string|max:255',
            'duration' => 'sometimes|string',
            'selected_destination' => 'sometimes|string',
            'itinerary_theme_string' => 'sometimes|string',
            'status_flags_string' => 'nullable|string',
            'destination_thumbnail' => 'nullable|string|max:255', // This will be handled after upload
            'destination_images' => 'nullable', // This will be handled after upload
            'destination_thumbnail_file' => 'nullable|image', // 2MB max size
            'destination_images_files.*' => 'nullable|image', // Multiple images
        ];
    }
}
