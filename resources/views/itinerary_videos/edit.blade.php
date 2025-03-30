@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">

        <a href="{{ route('itinerary.show', $itinerary_video->itinerary_id) }}" class="btn btn-sm btn-info">View Related Itinerary</a>

        <h1 class="mb-4">Edit Itinerary Video</h1>

        <form action="{{ route('itinerary-video.update', $itinerary_video->id) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
            @csrf
            @method('PUT')

            <!-- Video File Input -->
            <div class="mb-3">
                <label for="video_file" class="form-label">Video File</label>
                <input type="file" name="video_file" id="video_file" class="form-control">
                <small class="form-text text-muted">Upload a new video file (max size: 20MB).</small>

                @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <!-- Destination Dropdown -->
            <div class="mb-3">
                <label for="itinerary_id" class="form-label">Itinerary Id</label>
                <input name="itinerary_id" type="text" value="{{$itinerary_video->itinerary_id}}" readonly class="form-control">

                @error('itinerary_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Update
            </button>
        </form>
    </div>
@endsection