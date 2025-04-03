@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Add New Video Testimonial</h1>
    
    <form action="{{ route('video-testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="video_file">Video File</label>
            <input type="file" name="video_file" id="video_file" class="form-control" required>
            @error('video_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="visibility">Visibility</label>
            <select name="visibility" id="visibility" class="form-control" required>
                <option value="private" selected>Private</option>
                <option value="public">Public</option>
            </select>
            @error('visibility')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('video-testimonials.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection