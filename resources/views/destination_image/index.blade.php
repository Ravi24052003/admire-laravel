@extends('dashboard_layout.app')

@section('content')
    <h1>Destination Images</h1>
    <a href="{{ route('destination-images.create') }}" class="btn btn-primary">Upload Images</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Destination</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->destination }}</td>
                    <td>
                        @foreach (array_slice($image->images, 0, 5) as $img)
                            <img src="{{ $img }}" alt="Image" width="50">
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('destination-images.show', $image->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('destination-images.edit', $image->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('destination-images.destroy', $image->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection