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
             












                <div class="card-body">
                    @if(count($resort->images ?? []) > 0)
                        <div class="row">
                            @foreach($resort->images as $image)
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ asset($image) }}" class="card-img-top" alt="Gallery Image" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            @if(in_array($image, $resort->public_images ?? []))
                                                <span class="badge bg-success mb-2">Public</span>
                                            @else
                                                <span class="badge bg-secondary mb-2">Private</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No images found.</div>
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