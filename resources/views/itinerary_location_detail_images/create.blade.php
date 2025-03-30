@extends('dashboard_layout.app')

@section('content')
    <h1>Upload Images</h1>
    <form action="{{ route('itinerary-location-detail-images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="destination">Destination</label>
            <select class="form-control" name="destination" id="destination" required>
            <option value="">Select Destination</option>
            </select>
            @error('destination')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images_files[]" id="images" multiple class="form-control" accept="image/*">
            @error('images_files')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection

@section("script")
    <script src="{{asset("js/itinerary_location_detail_images/create.js")}}"></script>
@endsection