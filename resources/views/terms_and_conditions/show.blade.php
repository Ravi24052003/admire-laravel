@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Terms and Condition Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Destination: {{ $terms_and_condition->destination }}</h5>
            <p class="card-text"><strong>Terms and Conditions:</strong> {!! $terms_and_condition->terms_and_conditions !!}</p>
            <a href="{{route('terms-and-conditions.index')}}" class="btn btn-primary">Back to List</a>
            <a href="{{ route('terms-and-conditions.edit', $terms_and_condition->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('terms-and-conditions.destroy', $terms_and_condition->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection