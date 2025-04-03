@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Edit Destination</h1>
        
        <form action="{{ route('destinations.update', $destination) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="domestic_or_international">Type</label>
                <select name="domestic_or_international" id="domestic_or_international" class="form-control" required>
                    <option value="domestic" {{ $destination->domestic_or_international == 'domestic' ? 'selected' : '' }}>Domestic</option>
                    <option value="international" {{ $destination->domestic_or_international == 'international' ? 'selected' : '' }}>International</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="destination_name">Destination Name</label>
                <input type="text" name="destination_name" id="destination_name" class="form-control" value="{{ $destination->destination_name }}" required>
                @error('destination_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update Destination</button>
        </form>
    </div>
@endsection