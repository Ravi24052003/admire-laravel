@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Video Banner</h1>

        <!-- Hidden input to store destination data -->
        <div id="_destination" data-destination="{{ $video_banner->destination }}"></div>

        <form action="{{ route('selected-destination-video-banner.update', $video_banner) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
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
                <label for="destination" class="form-label">Destination</label>
                <select name="destination" id="destination" class="form-select" required>
                    <option value="">Select Destination</option>
                    <!-- Add options dynamically using JavaScript -->
                </select>

                @error('destination')
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

@section('script')
    <script src="{{ asset('js/video_banners/edit.js') }}"></script>
@endsection