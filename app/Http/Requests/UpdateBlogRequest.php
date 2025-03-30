<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'blog_title' => 'required|string|max:255',
            'blog_slug' => 'required|string|max:255|unique:blogs,blog_slug,' . $this->route('blog')->id,
            'blog_description' => 'required|string',
            'blog_author_name' => 'nullable|string|max:255',
            'blog_category' => 'required|string|max:255',
            'blog_visibility' => 'required|in:public,private',
            'blog_content' => 'required|string',
            'blog_image' => 'nullable',
            'blog_image_alt_text' => 'required|string|max:255',
            'blog_images' => 'nullable',
            'blog_meta_title' => 'required|string|max:255',
            'blog_meta_description' => 'required|string',
            'blog_meta_keywords' => 'required|string|max:255',
            'blog_image_file' => 'nullable|image|max:2048',
            'blog_images_files.*' => 'nullable|image|max:2048',
        ];
    }
}