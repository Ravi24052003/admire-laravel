@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Special Notes</h1>
    <a href="{{ route('special-notes.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S no.</th>
                <th>Destination</th>
                <th>Special Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($special_notes as $index=>$special_note)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $special_note->destination }}</td>
                    <td>{!! Str::limit($special_note->special_note, 50) !!}</td>
                    <td>
                        <a href="{{ route('special-notes.show', $special_note->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('special-notes.edit', $special_note->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('special-notes.destroy', $special_note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection