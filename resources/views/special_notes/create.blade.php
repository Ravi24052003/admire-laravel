@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Create Special Note</h1>
    <form action="{{ route('special-notes.store') }}" method="POST">
        @csrf
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
            <textarea name="special_note" id="special_note" class="form-control" required></textarea>
            @error('special_note')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection


@section("script")
<script src="{{asset('js/special_note/create.js')}}"></script>
@endsection