@extends('dashboard_layout.app')

@section('content')
    <h1>Upload Images</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('destination-images.store', ['destination_type'=>'weekend_gateway']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <input type="text" class="form-control" id="domestic_or_international" name="domestic_or_international" value="domestic" required readonly>
            <p id="domestic_or_internationalErr" class="text-danger small"></p>
        </div>

        <div class="form-group">
            <label for="destination">Select Destination</label>
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



        <div class="form-group">
            <label for="public_images">Images Visibility</label>
            <select name="public_images" id="public_images" class="form-control">
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>
        </div>        


        <input type="hidden" name="destination_type" value='["weekend_gateway"]'>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection