@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Images</h1>

    <div id="_destination" data-destination="{{ $itinerary_location_detail_image->destination }}"></div>


    <form action="{{ route('itinerary-location-detail-images.update', $itinerary_location_detail_image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Destination Dropdown -->
        <div class="form-group">
            <label for="destination">Destination</label>
            <select class="form-control" name="destination" id="destination" required>
                <option value="">Select Destination</option>
                <!-- Add options dynamically here -->
            </select>
            @error('destination')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Display Existing Images with Remove Buttons -->
        <div class="form-group">
            <label>Existing Images</label>
            <div class="existing-images d-flex flex-wrap align-items-start gap-2">
                @foreach ($itinerary_location_detail_image->images as $index => $image)
                <div class="image-container  border border-2 border-gray-500 text-center p-2 m-2">
                    <img src="{{ asset($image) }}" alt="Image" width="100" data-image-path="{{ $image }}">
                    <br>
                    <button type="button" class="btn btn-danger btn-sm remove-img-btn mt-2" data-image_path="{{ $image }}">Remove</button>
                </div>
                
                @endforeach
            </div>
        </div>

        <!-- Input for Uploading New Images -->
        <div class="form-group">
            <label for="images">Upload New Images</label>
            <input type="file" name="images_files[]" id="images" multiple class="form-control">
            @error('images_files')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hidden Input to Store Removed Image Paths as JSON -->
        <input type="hidden" name="removed_images" id="removed_images">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section("script")
  <script src="{{asset("js/itinerary_location_detail_images/edit.js")}}"></script>
@endsection