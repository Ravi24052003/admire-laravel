@extends('dashboard_layout.app')

@section('content')
    <h1>Upload Images</h1>


    <form method="GET" action="{{ route('itinerary-location-detail-images.create') }}">
        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <select class="form-control" id="domestic_or_international" name="domestic_or_international" onchange="this.form.submit()" required>
                <option value="">Select Destination Type</option>
                <option value="domestic" {{ $type == 'domestic' ? 'selected' : '' }}>Domestic</option>
                <option value="international" {{ $type == 'international' ? 'selected' : '' }}>International</option>
            </select>
            <p id="domestic_or_internationalErr" class="text-danger small"></p>
        </div>
    </form>


    <form action="{{ route('itinerary-location-detail-images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="form-group">
            <label for="destination">Destinations</label>
            <div class="input-group">
                <select class="form-control" name="destination" id="destination" required>
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->destination_name }}">{{ $destination->destination_name }}</option>
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
            <label for="images">Images</label>
            <input type="file" name="images_files[]" id="images" multiple class="form-control" accept="image/*">
            @error('images_files')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection