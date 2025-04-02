@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Video Testimonial Details</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Video</label>
                @if($video_testimonial->video_url)
                    <div class="mb-3">
                        <video width="400" controls>
                            <source src="{{ asset($video_testimonial->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @else
                    <p>No video uploaded</p>
                @endif
            </div>
            
            <div class="form-group">
                <label>Visibility</label>
                <p>{{ ucfirst($video_testimonial->visibility) }}</p>
            </div>
            
            <div class="form-group">
                <label>Created At</label>
                <p>{{ $video_testimonial->created_at->format('M d, Y H:i') }}</p>
            </div>
            
            <div class="form-group">
                <label>Updated At</label>
                <p>{{ $video_testimonial->updated_at->format('M d, Y H:i') }}</p>
            </div>
            
            <a href="{{ route('video-testimonials.edit', $video_testimonial->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('video-testimonials.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection