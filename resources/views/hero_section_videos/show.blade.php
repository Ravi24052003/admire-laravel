@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Hero Section Video Details</h1>

        @error('use_in')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    @error('video_file')
    <div class="text-danger">{{ $message }}</div>
@enderror

        <!-- Destination -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Used In</h5>
                <p class="card-text">{{ $video->use_in }}</p>
            </div>
        </div>

        <!-- Video Player -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Video</h5>
                <video src="{{ asset($video->video_url) }}" controls class="w-100"></video>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex gap-2">
            <a href="{{ route('selected-destination-video-banner.edit', $video->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <form action="{{ route('selected-destination-video-banner.destroy', $video->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endsection