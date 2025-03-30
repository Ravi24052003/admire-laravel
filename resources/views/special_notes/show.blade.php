@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Special Note Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Destination: {{ $special_note->destination }}</h5>
            <p class="card-text"><strong>Special Note:</strong> {!! $special_note->special_note !!}</p>
            <a href="{{ route('special-notes.edit', $special_note->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('special-notes.destroy', $special_note->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection