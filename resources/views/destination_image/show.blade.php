@extends('dashboard_layout.app')

@section('content')
    <h1>Image Details</h1>
    <div>
        @foreach ($destination_image->images as $img)
            <img src="{{ asset($img) }}" alt="Image" width="200">
        @endforeach
    </div>
    <a href="{{ route('destination-images.index') }}" class="btn btn-secondary">Back</a>
@endsection