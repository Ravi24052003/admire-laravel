@extends('dashboard_layout.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Back button -->
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary mb-4">
                    <i class="fas fa-arrow-left"></i> Back to Blogs
                </a>

                <!-- Main Blog Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Blog Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <h1 class="mb-3">{{ $blog->blog_title }}</h1>
                                <p class="lead">{{ $blog->blog_description }}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Blog Information</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Slug:</strong>
                                                <span>{{ $blog->blog_slug }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Category:</strong>
                                                <span class="badge bg-primary">{{ $blog->blog_category }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Visibility:</strong>
                                                <span class="badge bg-{{ $blog->blog_visibility === 'public' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($blog->blog_visibility) }}
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Author:</strong>
                                                <span>{{ $blog->blog_author_name ?? 'Not specified' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Created By User ID:</strong>
                                                <span>{{ $blog->user_id }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Created At:</strong>
                                                <span>{{ $blog->created_at->format('F j, Y H:i') }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>Updated At:</strong>
                                                <span>{{ $blog->updated_at->format('F j, Y H:i') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="blog-featured-image mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Featured Image</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset($blog->blog_image) }}" 
                                         alt="{{ $blog->blog_image_alt_text }}" 
                                         class="img-fluid rounded" style="max-height: 400px;">
                                    @if($blog->blog_image_alt_text)
                                        <div class="mt-2">
                                            <strong>Image Alt Text:</strong> 
                                            <p class="text-muted">{{ $blog->blog_image_alt_text }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Blog Content -->
                        <div class="blog-content mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Content</h5>
                                </div>
                                <div class="card-body">
                                    {!! $blog->blog_content !!}
                                </div>
                            </div>
                        </div>

                        <!-- Additional Images Gallery -->
                        @if($blog->blog_images && count($blog->blog_images))
                            <div class="blog-gallery mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Image Gallery</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            @foreach($blog->blog_images as $image)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <img src="{{ asset($image) }}" 
                                                             alt="Gallery image {{ $loop->iteration }}"
                                                             class="card-img-top img-thumbnail">
                                                        <div class="card-body text-center">
                                                            <small class="text-muted">Image {{ $loop->iteration }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO Information Card -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">SEO Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Meta Title:</strong>
                                    <p>{{ $blog->blog_meta_title }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong>Meta Keywords:</strong>
                                    <p>{{ $blog->blog_meta_keywords }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Meta Description:</strong>
                                    <p>{{ $blog->blog_meta_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Actions -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Blog
                            </a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this blog post?')">
                                    <i class="fas fa-trash"></i> Delete Blog
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection