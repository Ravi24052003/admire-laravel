@extends('dashboard_layout.app')

@section('content')
    <h1>Edit Counter</h1>

    <form action="{{ route('counters.update', $counter) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="packages" class="form-label">Packages</label>
            <input type="number" class="form-control" id="packages" name="packages" value="{{ $counter->packages }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="destinations_covered" class="form-label">Destinations Covered</label>
            <input type="number" class="form-control" id="destinations_covered" name="destinations_covered" value="{{ $counter->destinations_covered }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="years_in_business" class="form-label">Years in Business</label>
            <input type="number" class="form-control" id="years_in_business" name="years_in_business" value="{{ $counter->years_in_business }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select class="form-select" id="rating" name="rating" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $counter->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select class="form-select" id="visibility" name="visibility" required>
                <option value="private" {{ $counter->visibility === 'private' ? 'selected' : '' }}>Private</option>
                <option value="public" {{ $counter->visibility === 'public' ? 'selected' : '' }}>Public</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Counter</button>
        <a href="{{ route('counters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection