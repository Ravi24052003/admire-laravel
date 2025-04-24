@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Resort</h1>

    <form action="{{ route('resorts.update', $resort) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $resort->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select class="form-select" id="visibility" name="visibility" required>
                <option value="private" {{ old('visibility', $resort->visibility ?? 'private') == 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ old('visibility', $resort->visibility ?? 'private') == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="text" class="form-control" id="discount" name="discount" 
            value="{{ old('discount', $resort->discount ?? '') }}">

            @error('discount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>





          <!-- Display Existing Images with Remove Buttons -->
          <div class="form-group">
            <label>Existing Images</label>
            <div class="existing-images d-flex flex-wrap align-items-start gap-2">
                @foreach ($resort->images as $index => $image)
                <div class="image-container border border-2 border-gray-500 text-center p-2 m-2 position-relative">
                    <!-- Checkbox in the top-right corner -->
                    <input type="checkbox" class="public-img-checkbox position-absolute" style="top: 5px; right: 5px;" data-image_path="{{ $image }}" {{ $resort->public_images && in_array($image, $resort->public_images) ? 'checked' : '' }}>
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

        <input type="hidden" name="public_images" id="public_images" value='@json($resort->public_images)'>






        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('resorts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection


@section("script")
  <script src="{{asset("js/resorts/edit.js")}}"></script>
@endsection