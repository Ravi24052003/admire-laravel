@extends('dashboard_layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Counters</h1>
        <a href="{{ route('counters.create') }}" class="btn btn-primary">Create New Counter</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Packages</th>
                <th>Destinations Covered</th>
                <th>Years in Business</th>
                <th>Rating</th>
                <th>Visibility</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($counters as $counter)
                <tr>
                    <td>{{ $counter->id }}</td>
                    <td>{{ $counter->packages }}</td>
                    <td>{{ $counter->destinations_covered }}</td>
                    <td>{{ $counter->years_in_business }}</td>
                    <td>{{ str_repeat('★', $counter->rating) }}{{ str_repeat('☆', 5 - $counter->rating) }}</td>
                    <td>
                        <span class="badge bg-{{ $counter->visibility === 'public' ? 'success' : 'secondary' }}">
                            {{ ucfirst($counter->visibility) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('counters.show', $counter) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('counters.edit', $counter) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('counters.destroy', $counter) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection