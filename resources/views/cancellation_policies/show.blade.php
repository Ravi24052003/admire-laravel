@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Cancellation Policy Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Cancellation Policy:</strong> {!! $cancellation_policy->cancellation_policy !!}</p>
            <a href="{{ route('cancellation-policies.edit', $cancellation_policy->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('cancellation-policies.destroy', $cancellation_policy->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection