@extends('dashboard_layout.app')

@section('content')
    <h1>Hero Section Videos</h1>
    <a href="{{ route('hero-section-videos.create') }}" class="btn btn-primary">Add New Video</a>
    <table class="table">
        <thead>
            <tr>
                <th>S no.</th>
                <th>Used In</th>
                <th>Visibility</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $index=>$video)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $video->use_in }}</td>
                    <td>{{ $video->visibility }}</td>
                    <td>
                        <a href="{{ route('hero-section-videos.show', $video->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('hero-section-videos.edit', $video->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('hero-section-videos.destroy', $video->id) }}" method="POST" style="display:inline;">
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