@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Terms and Conditions</h1>
    <a href="{{ route('terms-and-conditions.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Destination</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($termsAndConditions as $index => $terms_and_condition)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $terms_and_condition->destination }}</td>
                    <td>
                        <a href="{{ route('terms-and-conditions.show', $terms_and_condition->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('terms-and-conditions.edit', $terms_and_condition->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('terms-and-conditions.destroy', $terms_and_condition->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection