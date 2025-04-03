@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Video Testimonial</h1>
    
    <form action="{{ route('video-testimonials.update', $video_testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$video_testimonial->title}}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Current Video</label>
            @if($video_testimonial->video_url)
                <div class="mb-3">
                    <video width="200" controls>
                        <source src="{{ asset($video_testimonial->video_url) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
            <label for="video_file">Replace Video File</label>
            <input type="file" name="video_file" id="video_file" class="form-control">
            @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="visibility">Visibility</label>
            <select name="visibility" id="visibility" class="form-control" required>
                <option value="private" {{ $video_testimonial->visibility === 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ $video_testimonial->visibility === 'public' ? 'selected' : '' }}>Public</option>
            </select>
            @error('visibility')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('video-testimonials.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection