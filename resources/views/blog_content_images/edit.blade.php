@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Blog Images: {{ $image->blog_slug }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog-content-images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="blog_slug" class="form-label">Blog Post *</label>
                            <select class="form-select @error('blog_slug') is-invalid @enderror" 
                                    id="blog_slug" name="blog_slug" required>
                                <option value="">-- Select Blog Post --</option>
                                @foreach($blogPosts as $post)
                                <option value="{{ $post->slug }}" 
                                    @selected(old('blog_slug', $image->blog_slug) == $post->slug)>
                                    {{ $post->title }} ({{ $post->slug }})
                                </option>
                                @endforeach
                            </select>
                            @error('blog_slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Current Images</label>
                            <div class="row g-2 mb-3">
                                @foreach(json_decode($image->images) as $index => $imgPath)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card">
                                        <img src="{{ asset($imgPath) }}" class="card-img-top" 
                                             style="height: 100px; object-fit: cover;">
                                        <div class="card-body p-2 text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="delete_image_{{ $index }}" name="delete_images[]" 
                                                       value="{{ $imgPath }}">
                                                <label class="form-check-label small" for="delete_image_{{ $index }}">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <small class="text-muted">Check images you want to remove</small>
                        </div>

                        <div class="mb-4">
                            <label for="images_files" class="form-label">Add New Images</label>
                            <input type="file" class="form-control @error('images_files') is-invalid @enderror" 
                                   id="images_files" name="images_files[]" multiple>
                            @error('images_files')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Select additional images (optional)</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blog-content-images.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Images
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection