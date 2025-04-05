<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItineraryVideoRequest extends FormRequest
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
            'itinerary_id' => 'sometimes|string|unique:itinerary_video,itinerary_id,' . $this->route('itinerary_video')->id,
            'video_url' => 'nullable|string',
            'video_file' => 'sometimes|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/x-matroska',
        ];
    }
}
