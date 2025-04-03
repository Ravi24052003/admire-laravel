@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Destinations</h1>
        
        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="{{ route('destinations.index') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <select name="type" class="form-control" onchange="this.form.submit()">
                            <option value="">All Types</option>
                            <option value="domestic" {{ request('type') == 'domestic' ? 'selected' : '' }}>Domestic</option>
                            <option value="international" {{ request('type') == 'international' ? 'selected' : '' }}>International</option>
                        </select>
                    </div>
                    <a href="{{ route('destinations.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('destinations.create') }}" class="btn btn-primary">Add New Destination</a>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($destinations as $index => $destination)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($destination->domestic_or_international) }}</td>
                        <td>{{ $destination->destination_name }}</td>
                        <td>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-info">View</a>
                            <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('destinations.destroy', $destination) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($destinations->isEmpty())
            <div class="alert alert-info">No destinations found.</div>
        @endif
    </div>
@endsection