@extends('dashboard_layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gallery Details</h1>
        <div>
            <a href="{{ route('destination-galleries.edit', $destination_gallery->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('destination-galleries.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Basic Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Type</th>
                            <td>{{ ucfirst($destination_gallery->domestic_or_international) }}</td>
                        </tr>
                        <tr>
                            <th>Destination</th>
                            <td>{{ $destination_gallery->destination }}</td>
                        </tr>
                        <tr>
                            <th>Gallery Type</th>
                            <td>{{ ucfirst($destination_gallery->gallery_type) }}</td>
                        </tr>
                        <tr>
                            <th>Visibility</th>
                            <td>
                                <span class="badge bg-{{ $destination_gallery->visibility == 'public' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($destination_gallery->visibility) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Images</th>
                            <td>{{ count($destination_gallery->images ?? []) }}</td>
                        </tr>
                        <tr>
                            <th>Public Images</th>
                            <td>{{ count($destination_gallery->public_images ?? []) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Gallery Images</h5>
        </div>
        <div class="card-body">
            @if(count($destination_gallery->images ?? []) > 0)
                <div class="row">
                    @foreach($destination_gallery->images as $image)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset($image) }}" class="card-img-top" alt="Gallery Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    @if(in_array($image, $destination_gallery->public_images ?? []))
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
                <div class="alert alert-info">No images found in this gallery.</div>
            @endif
        </div>
    </div>
@endsection