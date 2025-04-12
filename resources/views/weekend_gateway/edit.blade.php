@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Images</h1>

    <div id="_destination" data-destination="{{ $destination_image->destination }}"></div>


    <form action="{{ route('destination-images.update', [ 'destination_image'=>$destination_image->id, 'destination_type'=>'weekend_gateway']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <input type="text" class="form-control" id="domestic_or_international" name="domestic_or_international" value="domestic" required readonly>
            <p id="domestic_or_internationalErr" class="text-danger small"></p>
        </div>


        <div class="form-group">
            <label for="destination">Select Destination</label>
            <div class="input-group">
                <select class="form-control" name="destination" id="destination" required>
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->destination_name }}" {{($destination_image->destination == $destination->destination_name)? 'selected' : ''}}>{{ $destination->destination_name }}</option>
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
                @foreach ($destination_image->images as $index => $image)
                <div class="image-container border border-2 border-gray-500 text-center p-2 m-2 position-relative">
                    <!-- Checkbox in the top-right corner -->
                    <input type="checkbox" class="public-img-checkbox position-absolute" style="top: 5px; right: 5px;" data-image_path="{{ $image }}" {{ $destination_image->public_images && in_array($image, $destination_image->public_images) ? 'checked' : '' }}>
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

        <input type="hidden" name="public_images" id="public_images" value='@json($destination_image->public_images)'>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section("script")
  <script src="{{asset("js/weekend_gateway/edit.js")}}"></script>
@endsection