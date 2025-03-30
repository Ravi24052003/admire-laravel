@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Create Cancellation Policy</h1>
    <form action="{{ route('cancellation-policies.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cancellation_policy">Cancellation Policy</label>
            <textarea name="cancellation_policy" id="cancellation_policy" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('script')
    <script src="{{asset("js/cancellation_policy/create.js")}}"></script>
@endsection