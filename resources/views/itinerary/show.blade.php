
@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Itinerary Details</h1>

    <div class="card">
        <div class="card-body">
            <!-- Basic Information -->
            <h3 class="card-title"> <strong>Title:</strong> {{ $itineraryResource->title }}</h3>
            <p class="card-text"><strong>Slug:</strong> {{ $itineraryResource->slug }}</p>
            <p class="card-text"><strong>Type:</strong> {{ ucfirst($itineraryResource->domestic_or_international) }}</p>
            <p class="card-text"><strong>Duration:</strong> {{ $itineraryResource->duration }}</p>
            <p class="card-text"><strong>Selected Destination:</strong> {{ $itineraryResource->selected_destination }}</p>
            <p class="card-text"><strong>Pricing:</strong> {{ $itineraryResource->pricing ?? 'N/A' }}</p>
            <p class="card-text"><strong>Visibility:</strong> {{ ucfirst($itineraryResource->itinerary_visibility) }}</p>
            <p class="card-text"><strong>Itinerary Type:</strong> {{ ucfirst($itineraryResource->itinerary_type) }}</p>

            <!-- Destination Details -->
            <h4 class="mt-4">Destination Details</h4>
            <div>{!! $itineraryResource->destination_detail !!}</div>

            <!-- Inclusion and Exclusion -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Inclusions</h5>
                    <p class="card-text">{!! $itineraryResource->inclusion ?? 'N/A' !!}</p>
                </div>
                <div class="col-md-6">
                    <h5>Additional Inclusion</h5>
                    <p class="card-text">{!! $itineraryResource->additional_inclusion ?? 'N/A' !!}</p>
                </div>
                <div class="col-md-6">
                    <h5>Exclusions</h5>
                    <p class="card-text">{!! $itineraryResource->exclusion ?? 'N/A' !!}</p>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <h4 class="mt-4">Terms and Conditions</h4>
            <p class="card-text">{!! $itineraryResource->terms_and_conditions ?? 'N/A' !!}</p>

            <!-- Hotel Details -->
            {{-- <h4 class="mt-4">Hotel Details</h4>
            <div class="row">
                @foreach ($itineraryResource->hotel_details as $hotel)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $hotel['hotel_type'] }}</h5>
                                <p class="card-text"><strong>Room Type:</strong> {{ $hotel['room_type'] }}</p>
                                <p class="card-text"><strong>Price:</strong> {{ $hotel['price'] }}</p>
                                <p class="card-text"><strong>Discount:</strong> {{ $hotel['discount'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <!-- Days Information -->
            <h4 class="mt-4">Days Information</h4>
            <div class="row">
                @foreach ($itineraryResource->days_information as $day)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Day {{ $loop->iteration }}: {{ $day['title'] }}</h5>
                                <p class="card-text">{!! $day['detail'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Itinerary Themes -->
            <h4 class="mt-4">Itinerary Themes</h4>
            <ul>
                @foreach ($itineraryResource->itinerary_theme as $theme)
                    <li>{{ $theme }}</li>
                @endforeach
            </ul>

            <!-- Meta Information -->
            <h4 class="mt-4">Meta Information</h4>
            <p class="card-text"><strong>Meta Title:</strong> {{ $itineraryResource->meta_title ?? 'N/A' }}</p>
            <p class="card-text"><strong>Keyword:</strong> {{ $itineraryResource->keyword ?? 'N/A' }}</p>
            <p class="card-text"><strong>Meta Description:</strong> {{ $itineraryResource->meta_description ?? 'N/A' }}</p>

            <!-- Flags -->
            <h4 class="mt-4">Status Flags</h4>
            <ul>
                @foreach ($itineraryResource->status_flags as $flag)
                    <li>{{ $flag }}</li>
                @endforeach
            </ul>

            <!-- Images -->
            <h4 class="mt-4">Images</h4>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ asset($itineraryResource->destination_thumbnail) }}" class="card-img-top" alt="Thumbnail">
                        <div class="card-body">
                            <p class="card-text text-center"><strong>Thumbnail</strong></p>
                        </div>
                    </div>
                </div>
                @foreach ($itineraryResource->destination_images as $image)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset($image) }}" class="card-img-top" alt="Destination Image">
                            <div class="card-body">
                                <p class="card-text text-center"><strong>Image {{ $loop->iteration }}</strong></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Timestamps -->
            <h4 class="mt-4">Timestamps</h4>
            <p class="card-text"><strong>Created At:</strong> {{ $itineraryResource->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $itineraryResource->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('itinerary.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection