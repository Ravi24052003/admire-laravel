@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Blog Images: {{ $image->blog_slug }}</h1>
        <div>
            <a href="{{ route('blog-content-images.edit', $image->id) }}" class="btn btn-outline-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <form action="{{ route('blog-content-images.destroy', $image->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" 
                        onclick="return confirm('Delete this image set?')">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $image->id }}</p>
                    <p><strong>Blog Slug:</strong> {{ $image->blog_slug }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Created:</strong> {{ $image->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Updated:</strong> {{ $image->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Images ({{ count(json_decode($image->images)) }})</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach(json_decode($image->images) as $imgPath)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset($imgPath) }}" class="card-img-top" 
                             style="height: 180px; object-fit: cover;" alt="Blog Image">
                        <div class="card-body text-center">
                            <a href="{{ asset($imgPath) }}" target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-expand me-1"></i> Full View
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('blog-content-images.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>
@endsection