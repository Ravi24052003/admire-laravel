@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Create Video Banner</h1>



        <form method="GET" action="{{ route('selected-destination-video-banner.create') }}">
            <div class="form-group">
                <label for="domestic_or_international">Domestic or International</label>
                <select class="form-control" id="domestic_or_international" name="domestic_or_international" onchange="this.form.submit()" required>
                    <option value="">Select Destination Type</option>
                    <option value="domestic" {{ $type == 'domestic' ? 'selected' : '' }}>Domestic</option>
                    <option value="international" {{ $type == 'international' ? 'selected' : '' }}>International</option>
                </select>
                <p id="domestic_or_internationalErr" class="text-danger small"></p>
            </div>
        </form>




        <form action="{{ route('selected-destination-video-banner.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
            @csrf


            <div class="form-group">
                <label for="destination">Select Destination</label>
                <div class="input-group">
                    <select class="form-control" name="destination" id="destination" required>
                        <option value="">Select Destination</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->destination_name }}">{{ $destination->destination_name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">

                        <a href="{{ route('destinations.create', ['redirect_back_to' => url()->current()]) }}" 
                            class="btn btn-primary" type="button">
                             <i class="fas fa-plus"></i>
                         </a>

                    </div>
                </div>
                @error('destination')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            

            <!-- Video File Input -->
            <div class="mb-3">
                <label for="video_file" class="form-label">Video File</label>
                <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*" required>
                <small class="form-text text-muted">Upload a video file (max size: 20MB).</small>

                @error('video_file')
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