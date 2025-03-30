@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Create Terms and Condition</h1>
    <form action="{{ route('terms-and-conditions.store') }}" method="POST" class="mb-5">
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
            <label for="terms_and_conditions">Terms and Conditions</label>
            <textarea class="form-control" id="terms_and_conditions" name="terms_and_conditions" rows="3"></textarea>
            @error('terms_and_conditions')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
     
        <a href="{{route('terms-and-conditions.index')}}" class="btn btn-info">Back to List</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection


@section("script")
<script src="{{asset('js/terms_and_condition/create.js')}}"></script>
@endsection