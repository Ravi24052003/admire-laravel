@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>List of Itineraries</h1>
    


    <div id="_selected_destination" data-selected_destination="{{request('selected_destination')}}" ></div>


    <!-- Filter Form -->
    <form method="GET" action="{{ route('itinerary.index') }}" class="mb-4">
        <div class="row g-3">
            <!-- Sort Column -->
            <div class="col-md-3">
                <label class="form-label">Sort by Created Date</label>
                <select name="sort" class="form-select">
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>

            <!-- Destination Search -->

            <div class="col-md-3">
                <label for="selected_destination">Destination</label>
                <select class="form-control" name="selected_destination" id="selected_destination">
                    <option value="">Select Destination</option>
                    <!-- Populate options dynamically -->
                </select>
            </div>


            <!-- Type Filters -->
            <div class="col-md-3">
                <label for="itinerary_type">Itinerary Type</label>
                <select class="form-control" name="itinerary_type" id="itinerary_type">
                    <option value="">Select Itinerary Type</option>
                    <option value="flexible" {{ request('itinerary_type') === 'flexible' ? 'selected' : '' }}>Flexible departure</option>
                    <option value="fixed" {{ request('itinerary_type') === 'fixed' ? 'selected' : '' }}>Fixed departure</option>
                </select>
              
            </div>


            <!-- Domestic/International -->
            <div class="col-md-3">
                <label class="form-label">Location Type</label>
                <select name="domestic_or_international" class="form-select">
                    <option value="">Select Domestic or international</option>
                    <option value="domestic" {{ request('domestic_or_international') === 'domestic' ? 'selected' : '' }}>Domestic</option>
                    <option value="international" {{ request('domestic_or_international') === 'international' ? 'selected' : '' }}>International</option>
                </select>
            </div>

            <!-- Visibility -->
            <div class="col-md-3">
                <label class="form-label">Visibility</label>
                <select name="itinerary_visibility" class="form-select">
                    <option value="">Select Itinerary Visibility</option>
                    <option value="public" {{ request('itinerary_visibility') === 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ request('itinerary_visibility') === 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>


            {{-- Status Flags  --}}
            <div class="col-md-3">
                <label>Status Flags</label><br>
                <label><input type="checkbox" name="status_flags[]" value="is_trending"> Is Trending</label><br>
                <label><input type="checkbox" name="status_flags[]" value="is_exclusive"> Is Exclusive</label><br>
                <label><input type="checkbox" name="status_flags[]" value="is_weekend"> Is Weekend</label><br>
                <label><input type="checkbox" name="status_flags[]" value="is_gateway"> Is Gateway</label><br>
            </div>



            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold mb-2">From Date and To Date</label>
                <div class="d-flex gap-3">
                    <input 
                        type="date" 
                        name="from_date" 
                        class="form-control" 
                        placeholder="Select from date" 
                        value="{{ request('from_date') }}"
                    >
                    <input 
                        type="date" 
                        name="to_date" 
                        class="form-control" 
                        placeholder="Select to date" 
                        value="{{ request('to_date') }}"
                    >
                </div>

                @error('dateError')
                    <div class="text-danger">{{$message}}</div>
                @enderror

            </div>
            

            
            
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('itinerary.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
        </div>
    </form>

    <!-- Itineraries Table -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered">
            <!-- Table Header -->
            <thead>
                <tr>
                    <td>S no.</td>
                    <th>Title</th>
                    <th>Selected Destination</th>
                    <th>Pricing</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <!-- Table Body -->
            <tbody>
                @foreach($itinerariesResource as $index=>$itinerary)


                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $itinerary->title }}</td>
                        <td>{{ $itinerary->selected_destination }}</td>
                        <td>{{ $itinerary->pricing }}</td>
                        <td>{{ $itinerary->duration }}</td>
                        <td>
                            <a href="{{ route('itinerary.show', $itinerary->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('itinerary.edit', $itinerary) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('itinerary.destroy', $itinerary->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this itinerary?')">Delete</button>
                            </form>


                            <a href="{{ route('itinerary-video.create', $itinerary->id) }}" class="btn btn-sm  btn-primary mb-4 mt-4">
                                <i class="fas fa-plus"></i> Create Itinerary Video
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($itinerariesResource instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-4 d-flex justify-content-center">
        {{ $itinerariesResource->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endif


</div>

<style>
    .table-responsive {
        overflow-x: auto;
    }
    .table td, .table th {
        vertical-align: middle;
        min-width: 150px;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
    .form-check {
        margin-bottom: 0.5rem;
    }
</style>
@endsection


@section('script')
<script src="{{asset('js/itinerary/index.js')}}"></script>
@endsection