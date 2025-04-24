@extends('dashboard_layout.app')

@section('content')
    <h1>Create New Resort</h1>

    <form action="{{ route('resorts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        {{-- <div class="mb-3">
            <label for="image_file" class="form-label">Image</label>
            <input type="file" class="form-control" id="image_file" name="image_file" required>
        </div> --}}

        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="text" class="form-control" id="discount" name="discount" 
            value="{{ old('discount', $resort->discount ?? '') }}">

            @error('discount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select class="form-select" id="visibility" name="visibility" required>
                <option value="private" {{ old('visibility', $resort->visibility ?? 'private') == 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ old('visibility', $resort->visibility ?? 'private') == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>


        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images_files[]" id="images" multiple class="form-control" accept="image/*" required>
            @error('images_files')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>


        <div class="form-group">
            <label for="public_images">Images Visibility</label>
            <select name="public_images" id="public_images" class="form-control">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('resorts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection