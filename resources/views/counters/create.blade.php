@extends('dashboard_layout.app')

@section('content')
    <h1>Create New Counter</h1>

    <form action="{{ route('counters.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="packages" class="form-label">Packages</label>
            <input type="number" class="form-control" id="packages" name="packages" required min="0">
        </div>

        <div class="mb-3">
            <label for="destinations_covered" class="form-label">Destinations Covered</label>
            <input type="number" class="form-control" id="destinations_covered" name="destinations_covered" required min="0">
        </div>

        <div class="mb-3">
            <label for="years_in_business" class="form-label">Years in Business</label>
            <input type="number" class="form-control" id="years_in_business" name="years_in_business" required min="0">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select class="form-select" id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select class="form-select" id="visibility" name="visibility" required>
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Counter</button>
        <a href="{{ route('counters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection