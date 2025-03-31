@extends('dashboard_layout.app')

@section('content')
    <h1>Add New Hero Section Video</h1>

    <!-- Display general form errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hero-section-videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="video_file">Video File</label>
            <input type="file" name="video_file" id="video_file" class="form-control" required>
            <!-- Display error message for video_file -->
            @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="use_in">Use In</label>
            <select name="use_in" id="use_in" class="form-control" required>
                <option value="home">Home</option>
                <option value="domestic">Domestic</option>
                <option value="international">International</option>
                <option value="about">about</option>
                <option value="blog">Blog</option>
                <option value="contact">Contact</option>
            </select>
            @error('use_in')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="visibility">Visibility</label>
            <select name="visibility" id="visibility" class="form-control">
                <option value="private" {{ old('visibility') === 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ old('visibility') === 'public' ? 'selected' : '' }}>Public</option>
            </select>
            <!-- Display error message for visibility -->
            @error('visibility')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection