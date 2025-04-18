@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Destination Gallery</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div id="_destination" data-destination="{{ $destination_gallery->destination }}"></div>

    <form method="GET" action="{{ route('destination-galleries.edit', $destination_gallery) }}">
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

    <form action="{{ route('destination-galleries.update', $destination_gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="domestic_or_international" value="{{ !empty($type)? $type : '' }}">

        <div class="form-group">
            <label for="destination">Select Destination</label>
            <div class="input-group">
                <select class="form-control" name="destination" id="destination" required>
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->destination_name }}" {{($destination->destination_name == $destination_gallery->destination)? 'selected' : ''}} >{{ $destination->destination_name }}</option>
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

        <div class="form-group">
            <label for="gallery_type">Gallery Type</label>
            <select name="gallery_type" id="gallery_type" class="form-control">
                <option value="">Select Gallery Type</option>
                <option value="resort" {{ $destination_gallery->gallery_type == 'resort' ? 'selected' : '' }}>Resort</option>
                <option value="adventure" {{ $destination_gallery->gallery_type == 'adventure' ? 'selected' : '' }}>Adventure</option>
                <option value="culture" {{ $destination_gallery->gallery_type == 'culture' ? 'selected' : '' }}>Culture</option>
                <option value="activity" {{ $destination_gallery->gallery_type == 'activity' ? 'selected' : '' }}>Activity</option>
                <option value="destination" {{ $destination_gallery->gallery_type == 'destination' ? 'selected' : '' }}>Destination</option>
            </select>
        </div>

        <div class="form-group">
            <label for="visibility">Gallery Visibility</label>
            <select name="visibility" id="visibility" class="form-control">
                <option value="private" {{ $destination_gallery->visibility == 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ $destination_gallery->visibility == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>

        <div class="form-group">
            <label>Existing Images</label>
            <div class="existing-images d-flex flex-wrap align-items-start gap-2">
                @foreach ($destination_gallery->images as $index => $image)
                    <div class="image-container border border-2 border-gray-500 text-center p-2 m-2 position-relative">
                        <input type="checkbox" class="public-img-checkbox position-absolute" style="top: 5px; right: 5px;" 
                               data-image_path="{{ $image }}" 
                               {{ $destination_gallery->public_images && in_array($image, $destination_gallery->public_images) ? 'checked' : '' }}>
                        <img src="{{ asset($image) }}" alt="Image" width="100" data-image-path="{{ $image }}">
                        <br>
                        <button type="button" class="btn btn-danger btn-sm remove-img-btn mt-2" data-image_path="{{ $image }}">Remove</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="images_files">Upload New Images</label>
            <input type="file" name="images_files[]" id="images_files" multiple class="form-control">
        </div>

        <input type="hidden" name="removed_images" id="removed_images">
        <input type="hidden" name="public_images" id="public_images" value='@json($destination_gallery->public_images)'>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section("script")
  <script src="{{asset("js/destination_galleries/edit.js")}}"></script>
@endsection