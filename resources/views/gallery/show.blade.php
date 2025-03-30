@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h2>Gallery Image Details</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mt-4">
        <div class="card-body text-center">

            <div class="d-flex flex-wrap justify-content-start align-items-start">
                @foreach ($gallery->images as $img)
                    <img src="{{ asset($img) }}" alt="Image" width="100" class="m-2">
                @endforeach
            </div>
            

           
            <h4 class="mt-3">Visibility: 
                <span class="badge bg-{{ $gallery->visibility == 'public' ? 'success' : 'secondary' }}">
                    {{ ucfirst($gallery->visibility) }}
                </span>
            </h4>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('gallery.index') }}" class="btn btn-primary">Back to Gallery</a>
        <a href="{{ route('gallery.edit', $gallery) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
