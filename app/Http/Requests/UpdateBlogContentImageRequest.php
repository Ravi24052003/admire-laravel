<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogContentImageRequest extends FormRequest
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
            "blog_slug" => "sometimes|unique:blog_content_images,blog_slug," . $this->route('blog_content_image')->id,
            'images' => "nullable",
            'images_files.*' => 'sometimes|image'
        ];
    }
}
