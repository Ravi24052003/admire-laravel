@extends('dashboard_layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Itinerary Videos</h1>

        @if ($itineraryVideos->isEmpty())
            <div class="alert alert-info">
                No itinerary video found.
            </div>
        @else
        <div class="list-group">
            @foreach ($itineraryVideos as $index => $itineraryVideo)
                <div class="list-group-item bg-light border rounded shadow-sm p-3 mb-3">
                    <a href="{{ route('itinerary.show', $itineraryVideo->itinerary_id) }}" class="btn btn-sm btn-info w-100 fw-bold mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i> View Related Itinerary
                    </a>
        
                    <a href="{{ route('itinerary-video.show', $itineraryVideo->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-white border rounded shadow-sm p-2">
                        <span class="fw-bold text-primary">
                            <i class="fas fa-video me-2"></i> Video {{ $index + 1 }}
                        </span>
                        <span class="badge bg-secondary rounded-pill">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
        
        @endif


        @if($itineraryVideos instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4 d-flex justify-content-center">
            {{ $itineraryVideos->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    @endif


    </div>
@endsection