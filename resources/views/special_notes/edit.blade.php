@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Special Note</h1>

    <div id="_destination" data-destination="{{$special_note->destination}}" ></div>

    <form action="{{ route('special-notes.update', $special_note->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="destination">Destination</label>
            <select class="form-control" name="destination" id="destination" required>
            <option value="">Select Destination</option>
            </select>
            @error('destination')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="special_note">Special Note</label>
            <textarea name="special_note" id="special_note" class="form-control" required>{{ $special_note->special_note }}</textarea>
            @error('special_note')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section("script")
<script src="{{asset('js/special_note/edit.js')}}"></script>
@endsection