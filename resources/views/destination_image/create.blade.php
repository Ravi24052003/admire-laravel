@extends('dashboard_layout.app')

@section('content')
    <h1>Upload Images</h1>
    <form action="{{ route('destination-images.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="domestic_or_international">Domestic or International</label>
            <select class="form-control" id="domestic_or_international" name="domestic_or_international" required>
                <option value="domestic">Domestic</option>
                <option value="international">International</option>
            </select>
            <p id="domestic_or_internationalErr" class="text-danger small"></p>
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
    <script src="{{asset("js/destination_images/create.js")}}"></script>
@endsection