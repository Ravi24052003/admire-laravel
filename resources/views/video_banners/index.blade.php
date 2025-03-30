@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Video Banners</h1>
        <a href="{{ route('selected-destination-video-banner.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Create New
        </a>

        @if ($videoBanners->isEmpty())
            <div class="alert alert-info">
                No video banners found.
            </div>
        @else
            <div class="list-group">
                @foreach ($videoBanners as $videoBanner)
                    <a href="{{ route('selected-destination-video-banner.show', $videoBanner) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-video me-2"></i> {{ $videoBanner->destination }}
                        </span>
                        <span class="badge bg-secondary rounded-pill">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection