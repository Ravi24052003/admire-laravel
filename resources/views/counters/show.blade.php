@extends('dashboard_layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Counter Details</h1>
        <div>
            <a href="{{ route('counters.edit', $counter) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('counters.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Counter #{{ $counter->id }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Packages:</strong> {{ $counter->packages }}</li>
                <li class="list-group-item"><strong>Destinations Covered:</strong> {{ $counter->destinations_covered }}</li>
                <li class="list-group-item"><strong>Years in Business:</strong> {{ $counter->years_in_business }}</li>
                <li class="list-group-item"><strong>Rating:</strong> {{ str_repeat('★', $counter->rating) }}{{ str_repeat('☆', 5 - $counter->rating) }}</li>
                <li class="list-group-item">
                    <strong>Visibility:</strong> 
                    <span class="badge bg-{{ $counter->visibility === 'public' ? 'success' : 'secondary' }}">
                        {{ ucfirst($counter->visibility) }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
@endsection