@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Testimonial Details</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $image_and_text_testimonial->name }}</h5>
            <p class="card-text">
                Rating: {{ str_repeat('★', $image_and_text_testimonial->rating) }}{{ str_repeat('☆', 5 - $image_and_text_testimonial->rating) }}
            </p>
            
            <div class="mb-3">
                <h6>Main Image:</h6>
                @if($image_and_text_testimonial->image)
                    <img src="{{ asset($image_and_text_testimonial->image) }}" class="img-fluid" style="max-width: 300px;">
                @endif
            </div>


            <p class="card-text">
                <strong>Rating:</strong> {{ str_repeat('★', $image_and_text_testimonial->rating) }}{{ str_repeat('☆', 5 - $image_and_text_testimonial->rating) }}
            </p>
            <p class="card-text">
                <strong>Testimonial:</strong><br>
                {{ $image_and_text_testimonial->text }}
            </p>


            <h4 class="mt-3">Visibility: 
                <span class="badge bg-{{ $image_and_text_testimonial->visibility == 'public' ? 'success' : 'secondary' }}">
                    {{ ucfirst($image_and_text_testimonial->visibility) }}
                </span>
            </h4>
            
            @if($image_and_text_testimonial->images)
                <div class="mb-3">
                    <h6>Additional Images:</h6>
                    <div class="d-flex flex-wrap">
                        @foreach($image_and_text_testimonial->images as $image)
                            <img src="{{ asset($image) }}" class="img-thumbnail mr-2 mb-2" style="width: 150px; height: 150px;">
                        @endforeach
                    </div>
                </div>
            @endif
            
            <a href="{{ route('image-and-text-testimonials.edit', $image_and_text_testimonial->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('image-and-text-testimonials.destroy', $image_and_text_testimonial->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    
    <a href="{{ route('image-and-text-testimonials.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection