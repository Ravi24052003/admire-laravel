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
            <label for="current_image" class="form-label">Current Image</label>
            @if($resort->image)
                <img src="{{ asset($resort->image) }}" alt="{{ $resort->title }}" width="200" class="d-block mb-2">
            @else
                <p>No image</p>
            @endif
            <label for="image_file" class="form-label">New Image (Leave blank to keep current)</label>
            <input type="file" class="form-control" id="image_file" name="image_file">
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





        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('resorts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection