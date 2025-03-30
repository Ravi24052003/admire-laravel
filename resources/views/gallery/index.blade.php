@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h2>Gallery</h2>
    <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3">Add Image</a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($galleries->isEmpty())
        <div class="alert alert-warning">No images found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Images</th>
                    <th>Visibility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galleries as $gallery)
                    <tr>
                        <td>
                            @foreach (array_slice($gallery->images, 0, 5) as $img)
                                <img src="{{ $img }}" alt="Image" width="50">
                            @endforeach
                        </td>
                        <td>{{ ucfirst($gallery->visibility) }}</td>
                        <td>
                            <a href="{{ route('gallery.show', $gallery) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('gallery.edit', $gallery) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('gallery.destroy', $gallery) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
