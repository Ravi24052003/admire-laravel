@extends('dashboard_layout.app')

@section('content')
    <h1>Image Details</h1>
    <div>
        @foreach ($itinerary_location_detail_image->images as $img)
            <img src="{{ asset($img) }}" alt="Image" width="200">
        @endforeach
    </div>
    <a href="{{ route('itinerary-location-detail-images.index') }}" class="btn btn-secondary">Back</a>
@endsection