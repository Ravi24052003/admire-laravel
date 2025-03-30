@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h2>Edit Image</h2>

    <form action="{{ route('gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Display Existing Images with Remove Buttons -->
        <div class="form-group">
            <label>Existing Images</label>
            <div class="existing-images d-flex flex-wrap align-items-start gap-2">
                @foreach ($gallery->images as $index => $image)
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
        
        <div class="mb-3">
            <label>Visibility:</label>
            <select name="visibility" class="form-control">
                <option value="private" {{ $gallery->visibility == 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ $gallery->visibility == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

@section("script")
    <script src="{{asset("js/gallery/edit.js")}}"></script>
@endsection
