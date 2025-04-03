@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Destination Details</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $destination->destination_name }}</h5>
                <p class="card-text">
                    <strong>Type:</strong> {{ ucfirst($destination->domestic_or_international) }}
                </p>
                <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('destinations.destroy', $destination) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        
        <a href="{{ route('destinations.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection