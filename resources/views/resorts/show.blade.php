@extends('dashboard_layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Resort Details</h1>
        <div>
            <a href="{{ route('resorts.edit', $resort) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('resorts.destroy', $resort) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($resort->image)
                        <img src="{{ asset($resort->image) }}" alt="{{ $resort->title }}" class="img-fluid">
                    @else
                        <div class="text-center py-4 bg-light">No Image</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h2>{{ $resort->title }}</h2>
                    <p><strong>Visibility:</strong> {{ $resort->visibility ? 'Visible' : 'Hidden' }}</p>
                    <p><strong>Discount:</strong> {{ $resort->discount ? $resort->discount.'%' : 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $resort->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $resort->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('resorts.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection