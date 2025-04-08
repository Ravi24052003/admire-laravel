@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Images</h1>

    <div id="_destination" data-destination="{{ $itinerary_location_detail_image->destination }}"></div>


    <form method="GET" action="{{ route('itinerary-location-detail-images.edit', $itinerary_location_detail_image) }}">
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


    <form action="{{ route('itinerary-location-detail-images.update', $itinerary_location_detail_image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="destination">Select Destination</label>
            <div class="input-group">
                <select class="form-control" name="destination" id="destination" required>
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->destination_name }}" {{($destination->destination_name == $itinerary_location_detail_image->destination)? 'selected' : ''}} >{{ $destination->destination_name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">

                    <a href="{{ route('destinations.create', ['redirect_back_to' => url()->current()]) }}" 
                        class="btn btn-primary" type="button">
                         <i class="fas fa-plus"></i>
                     </a>

                </div>
            </div>
            <p id="selected_destinationErr" class="text-danger small"></p>
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
    <script src="{{asset('js/itinerary_location_detail_images/edit.js')}}"></script>
@endsection