@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Add New Destination</h1>
        
        <form action="{{ route('destinations.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="domestic_or_international">Type</label>
                <select name="domestic_or_international" id="domestic_or_international" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="domestic">Domestic</option>
                    <option value="international">International</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="destination_name">Destination Name</label>
                <input type="text" name="destination_name" id="destination_name" class="form-control" required>
                @error('destination_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            </div>


            @if (!empty($redirect_back_to))
    <input type="hidden" name="redirect_back_to" value="{{ $redirect_back_to }}">
@endif

            
            <button type="submit" class="btn btn-primary">Save Destination</button>
        </form>
    </div>
@endsection