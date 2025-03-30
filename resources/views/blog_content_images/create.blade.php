@extends('dashboard_layout.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create Blog Content Images</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog-content-images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="blog_slug" class="form-label">Blog Posts</label>
                            <select class="form-select @error('blog_slug') is-invalid @enderror" 
                                    id="blog_slug" name="blog_slug" required>
                                <option value="">-- Select Blog Post --</option>
                                @foreach($blogs as $blog)
                                <option value="{{ $blog->blog_slug }}" @selected(old('blog_slug') == $blog->blog_slug)>
                                    {{ $blog->blog_title }} ({{ $blog->blog_slug }})
                                </option>
                                @endforeach
                            </select>
                            @error('blog_slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="images_files" class="form-label">Images *</label>
                            <input type="file" class="form-control @error('images_files') is-invalid @enderror" 
                                   id="images_files" name="images_files[]" multiple required>
                            @error('images_files')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Select multiple images (JPG, PNG, max 2MB each)</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blog-content-images.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Images
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection