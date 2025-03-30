@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">

        <a href="{{ route('itinerary.show', $itinerary_video->itinerary_id) }}" class="btn btn-sm btn-info">View Related Itinerary</a>


        <h1 class="mb-4">Itinerary Video</h1>


    @error('video_file')
    <div class="text-danger">{{ $message }}</div>
@enderror

        <!-- Video Player -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Video</h5>
                <video src="{{ asset($itinerary_video->video_url) }}" controls class="w-100"></video>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex gap-2">
            <a href="{{ route('itinerary-video.edit', $itinerary_video->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <form action="{{ route('itinerary-video.destroy', $itinerary_video->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endsection