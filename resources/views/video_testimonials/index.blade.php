@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Video Testimonials</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('video-testimonials.create') }}" class="btn btn-primary">Add New Video Testimonial</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Video</th>
                    <th>Title</th>
                    <th>Visibility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($video_testimonials as $testimonial)
                <tr>
                    <td>
                        @if($testimonial->video_url)
                            <video width="200" controls>
                                <source src="{{ asset($testimonial->video_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </td>


                    <td>{{$testimonial->title}}</td>


                    <td>{{ ucfirst($testimonial->visibility) }}</td>
                    <td>
                        <a href="{{ route('video-testimonials.show', $testimonial->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('video-testimonials.edit', $testimonial->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('video-testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this video testimonial?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection