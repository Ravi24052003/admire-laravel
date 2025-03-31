@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Hero Section Video</h1>

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

    <form action="{{ route('hero-section-videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="video_file">Video File</label>
            <input type="file" name="video_file" id="video_file" class="form-control">
            <!-- Display error message for video_file -->
            @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="use_in">Use In</label>
            <select name="use_in" id="use_in" class="form-control" required>
                <option value="home" {{$video->use_in === 'home' ? 'selected' : ''}}>Home</option>
                <option value="domestic" {{$video->use_in === 'domestic' ? 'selected' : ''}}>Domestic</option>
                <option value="international" {{$video->use_in === 'international' ? 'selected' : ''}}>International</option>
                <option value="home" {{$video->use_in === 'home' ? 'selected' : ''}}>Home</option>
                <option value="about" {{$video->use_in === 'about' ? 'selected' : ''}}>about</option>
                <option value="blog" {{$video->use_in === 'blog' ? 'selected' : ''}}>Blog</option>
                <option value="contact" {{$video->use_in === 'contact' ? 'selected' : ''}}>Contact</option>
            </select>

            @error('use_in')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="visibility">Visibility</label>
            <select name="visibility" id="visibility" class="form-control">
                <option value="private" {{ old('visibility', $video->visibility) === 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ old('visibility', $video->visibility) === 'public' ? 'selected' : '' }}>Public</option>
            </select>
            <!-- Display error message for visibility -->
            @error('visibility')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection