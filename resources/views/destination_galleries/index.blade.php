@extends('dashboard_layout.app')

@section('content')

<form method="GET" action="{{ route('destination-galleries.index') }}">
    <div class="form-group">
        <label for="domestic_or_international_get_dstn">Domestic or International</label>
        <select class="form-control" id="domestic_or_international_get_dstn" name="domestic_or_international_get_dstn" onchange="this.form.submit()" required>
            <option value="">Select Destination Type</option>
            <option value="domestic" {{ request('domestic_or_international_get_dstn') == 'domestic' ? 'selected' : '' }}>Domestic</option>
            <option value="international" {{ request('domestic_or_international_get_dstn') == 'international' ? 'selected' : '' }}>International</option>
        </select>
        <p id="domestic_or_internationalErr" class="text-danger small"></p>
    </div>
</form>


<form method="GET" action="{{ route('destination-galleries.index') }}" class="mb-4">
    <div class="flex flex-wrap gap-4">


        <input type="hidden" name="domestic_or_international" value="{{request('domestic_or_international_get_dstn')}}">


        <div class="form-group">
            <label for="destination">Select Destination</label>
            <div class="input-group">
                <select class="form-control" name="destination" id="destination">
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->destination_name }}" {{($destination->destination_name == request('destination'))? 'selected' : ''}} >{{ $destination->destination_name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">

                    <a href="{{ route('destinations.create', ['redirect_back_to' => url()->current()]) }}" 
                        class="btn btn-primary" type="button">
                         <i class="fas fa-plus"></i>
                     </a>

                </div>
            </div>
            <p id="selected_destinationErr" class="text-danger small"></p>
        </div>



        <div class="form-group">
            <label for="gallery_type">Gallery Type</label>
            <select name="gallery_type" id="gallery_type" class="form-control">
                <option value="">Select Gallery Type</option>
                <option value="resort" {{request('gallery_type') == 'resort' ? 'selected' : ''}}>Resort</option>
                <option value="adventure" {{request('gallery_type') == 'adventure' ? 'selected' : ''}} >Adventure</option>
                <option value="culture" {{request('gallery_type') == 'culture' ? 'selected' : ''}} >Culture</option>
                <option value="activity" {{request('gallery_type') == 'activity' ? 'selected' : ''}} >Activity</option>
                <option value="destination" {{request('gallery_type') == 'destination' ? 'selected' : ''}} >Destination</option>
            </select>
        </div>



        <div class="row">
            <!-- Visibility Filter -->
            <div class="col-md-6 mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <select name="visibility" id="visibility" class="form-select">
                    <option value="">All Visibility</option>
                    <option value="public" {{ request('visibility') == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ request('visibility') == 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>
        
            <!-- Sort Direction -->
            <div class="col-md-6 mb-3">
                <label for="sort_direction" class="form-label">Sort Direction</label>
                <select name="sort_direction" id="sort_direction" class="form-select">
                    <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
        </div>
        



        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('destination-galleries.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
        </div>





    </div>
</form>





    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Destination Galleries</h1>
        <a href="{{ route('destination-galleries.create') }}" class="btn btn-primary">Create New Gallery</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Destination</th>
                            <th>Gallery Type</th>
                            <th>Visibility</th>
                            <th>Images Count</th>
                            <th>Public Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->id }}</td>
                                <td>{{ ucfirst($gallery->domestic_or_international) }}</td>
                                <td>{{ $gallery->destination }}</td>
                                <td>{{ ucfirst($gallery->gallery_type) }}</td>
                                <td>
                                    <span class="badge bg-{{ $gallery->visibility == 'public' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($gallery->visibility) }}
                                    </span>
                                </td>
                                <td>{{ count($gallery->images ?? []) }}</td>
                                <td>{{ count($gallery->public_images ?? []) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('destination-galleries.show', $gallery->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('destination-galleries.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('destination-galleries.destroy', $gallery->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection