<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoBannerRequest extends FormRequest
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
            'destination' => 'required|string|unique:selected_destination_video_banners,destination',
            'video_url' => 'nullable|string',
            'video_file' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/x-matroska',
        ];
    }
}
