@extends('dashboard_layout.app')

@section('content')
    <h1>Destination Images</h1>
    <a href="{{ route('destination-images.create', ['destination_type' => 'weekend_gateway']) }}" class="btn btn-primary">Upload Images</a>
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
                            <img src="{{ asset($img) }}" alt="Image" width="50">
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('destination-images.show', ['destination_image' => $image->id, 'destination_type'=>'weekend_gateway']) }}" class="btn btn-info">View</a>
                        <a href="{{ route('destination-images.edit', ['destination_image'=> $image->id, 'destination_type'=>'weekend_gateway']) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('destination-images.destroy', ['destination_image'=> $image->id, 'destination_type'=>'weekend_gateway']) }}" method="POST" style="display:inline;">
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