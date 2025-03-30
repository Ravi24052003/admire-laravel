@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Create Itinerary Video</h1>

        <form action="{{ route('itinerary-video.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
            @csrf

            <!-- Video File Input -->
            <div class="mb-3">
                <label for="video_file" class="form-label">Video File</label>
                <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*" required>
                <small class="form-text text-muted">Upload a video file (max size: 20MB).</small>

                @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            
            <div class="mb-3">
                <label for="itinerary_id" class="form-label">Itinerary Id</label>
                <input type="text" name="itinerary_id" value="{{$itinerary_id}}" class="form-control" readonly>

                @error('itinerary_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Create
            </button>

        </form>
    </div>
@endsection