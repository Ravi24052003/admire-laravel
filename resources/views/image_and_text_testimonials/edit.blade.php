@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Testimonial</h1>
    
    <form action="{{ route('image-and-text-testimonials.update', $image_and_text_testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $image_and_text_testimonial->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-control" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $image_and_text_testimonial->rating == $i ? 'selected' : '' }}>
                        {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}
                    </option>
                @endfor
            </select>
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="text">Testimonial Text</label>
            <textarea name="text" id="text" class="form-control" rows="5" required>{{ old('text', $image_and_text_testimonial->text) }}</textarea>
            @error('text')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label>Visibility:</label>
            <select name="visibility" class="form-control">
                <option value="private" {{ $image_and_text_testimonial->visibility == 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ $image_and_text_testimonial->visibility == 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Current Main Image</label><br>
            @if($image_and_text_testimonial->image)
                <img src="{{ asset($image_and_text_testimonial->image) }}" width="100" height="100" class="img-thumbnail mb-2">
            @endif
            <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*">
            @error('image_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Current Additional Images</label><br>
            @if($image_and_text_testimonial->images)
                @foreach($image_and_text_testimonial->images as $image)
                    <img src="{{ asset($image) }}" width="80" height="80" class="img-thumbnail mr-2 mb-2">
                @endforeach
            @endif
            <input type="file" name="images_files[]" id="images" multiple class="form-control" accept="image/*">
            @error('images_files')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection