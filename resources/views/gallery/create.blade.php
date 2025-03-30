@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h2>Add New Image</h2>

    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Image Files --}}
        <div class="mb-3">
            <label>Image Files:</label>
            <input type="file" name="images_files[]" class="form-control @error('images_files') is-invalid @enderror" multiple required>

            {{-- Display validation error --}}
            @error('images_files')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            @error('images_files.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Visibility Selection --}}
        <div class="mb-3">
            <label>Visibility:</label>
            <select name="visibility" class="form-control @error('visibility') is-invalid @enderror">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>

            {{-- Display validation error --}}
            @error('visibility')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>
@endsection
