@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Terms and Condition</h1>

    <div id="_destination" data-destination="{{$terms_and_condition->destination}}" ></div>


    <form action="{{ route('terms-and-conditions.update', $terms_and_condition->id) }}" method="POST">
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
            <label for="terms_and_conditions">Terms and Conditions</label>
            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control" required>{{ $terms_and_condition->terms_and_conditions }}</textarea>
            @error('terms_and_conditions')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
      
        <a href="{{route('terms-and-conditions.index')}}" class="btn btn-info">Back to List</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection


@section("script")
<script src="{{asset('js/terms_and_condition/edit.js')}}"></script>
@endsection