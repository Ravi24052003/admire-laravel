@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Testimonials</h1>
    <a href="{{ route('image-and-text-testimonials.create') }}" class="btn btn-primary mb-3">Create New</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Visibility</th>
                <th>Main Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr>
                <td>{{ $testimonial->name }}</td>
                <td>{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</td>
               
                <td>{{ ucfirst($testimonial->visibility) }}</td>
               
                <td>
                    @if($testimonial->image)
                    <img src="{{ asset($testimonial->image) }}" width="50" height="50" class="img-thumbnail">
                    @endif
                </td>
                <td>
                    <a href="{{ route('image-and-text-testimonials.show', $testimonial->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('image-and-text-testimonials.edit', $testimonial->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('image-and-text-testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection