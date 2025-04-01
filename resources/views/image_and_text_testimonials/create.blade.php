@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Create New Testimonial</h1>
    
    <form action="{{ route('image-and-text-testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="1">1 ★</option>
                <option value="2">2 ★★</option>
                <option value="3">3 ★★★</option>
                <option value="4">4 ★★★★</option>
                <option value="5">5 ★★★★★</option>
            </select>
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="text">Testimonial Text</label>
            <textarea name="text" id="text" class="form-control" rows="5" required></textarea>
            @error('text')
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
        
        <div class="form-group">
            <label for="image_file">Main Image</label>
            <input type="file" name="image_file" id="image_file" class="form-control" required accept="image/*">
            @error('image_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="images">Additional Images</label>
            <input type="file" name="images_files[]" id="images" multiple class="form-control" accept="image/*">
            @error('images_files')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection