@extends('dashboard_layout.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Create New Blog</h1>

           {{-- Display All Validation Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="blog_title" class="form-label">Title</label>
                <input type="text" name="blog_title" id="blog_title" value="{{ old('blog_title') }}" 
                       class="form-control" required>
                @error('blog_title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_slug" class="form-label">Slug</label>
                <input type="text" name="blog_slug" id="blog_slug" value="{{ old('blog_slug') }}" 
                       class="form-control" required>
                @error('blog_slug')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <p id="slugPreview" class="mt-1 text-muted"></p>
            </div>

            <div class="mb-3">
                <label for="blog_description" class="form-label">Description</label>
                <textarea name="blog_description" id="blog_description" rows="3"
                          class="form-control">{{ old('blog_description') }}</textarea>
                @error('blog_description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_author_name" class="form-label">Author Name</label>
                <input type="text" name="blog_author_name" id="blog_author_name" value="{{ old('blog_author_name') }}" 
                       class="form-control">
                @error('blog_author_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_category" class="form-label">Category</label>
                <select name="blog_category" id="blog_category" class="form-select">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_name }}" 
                            @if(old('blog_category') == $category->category_name) selected @endif>
                            {{ $category?->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('blog_category')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_visibility" class="form-label">Visibility</label>
                <select name="blog_visibility" id="blog_visibility" class="form-select">
                    <option value="public" @if(old('blog_visibility') == 'public') selected @endif>Public</option>
                    <option value="private" @if(old('blog_visibility') == 'private') selected @endif>Private</option>
                </select>
                @error('blog_visibility')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_content" class="form-label">Content</label>
                <textarea name="blog_content" id="blog_content" rows="10"
                          class="form-control">{{ old('blog_content') }}</textarea>
                @error('blog_content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_image_file" class="form-label">Blog Image</label>
                <input type="file" name="blog_image_file" id="blog_image_file" 
                       class="form-control" accept="image/*" required>
                @error('blog_image_file')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_image_alt_text" class="form-label">Blog Image Alternative Text</label>
                <input type="text" name="blog_image_alt_text" id="blog_image_alt_text" 
                       class="form-control" required>
                @error('blog_image_alt_text')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_images_files" class="form-label">Blog Images</label>
                <input type="file" name="blog_images_files[]" id="blog_images_files" 
                       class="form-control" multiple accept="image/*">     
                @error('blog_images_files')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_meta_title" class="form-label">Meta Title</label>
                <input type="text" name="blog_meta_title" id="blog_meta_title" value="{{ old('blog_meta_title') }}" 
                       class="form-control">
                @error('blog_meta_title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_meta_keywords" class="form-label">Meta Keywords (comma separated)</label>
                <input type="text" name="blog_meta_keywords" id="blog_meta_keywords" value="{{ old('blog_meta_keywords') }}" 
                       class="form-control">
                @error('blog_meta_keywords')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_meta_description" class="form-label">Blog meta description</label>
                <textarea name="blog_meta_description" id="blog_meta_description" rows="3"
                          class="form-control">{{ old('blog_meta_description') }}</textarea>
                @error('blog_meta_description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    Create Blog
                </button>
                <a href="{{ route('blogs.index') }}" class="btn btn-link text-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section("script")
    <script src={{asset('js/blog/create.js')}}></script>
@endsection