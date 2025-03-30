@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Cancellation Policy</h1>
    <form action="{{ route('cancellation-policies.update', $cancellation_policy->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cancellation_policy">Cancellation Policy</label>
            <textarea name="cancellation_policy" id="cancellation_policy" class="form-control" required>{{ $cancellation_policy->cancellation_policy }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection


@section("script")
    <script src="{{asset("js/cancellation_policy/edit.js")}}"></script>
@endsection