@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Cancellation Policies</h1>
    <a href="{{ route('cancellation-policies.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S no.</th>
                <th>Cancellation Policy</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cancellationPolicies as $index=>$cancellation_policy)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{!! Str::limit($cancellation_policy->cancellation_policy, 50) !!}</td>
                    <td>
                        <a href="{{ route('cancellation-policies.show', $cancellation_policy->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('cancellation-policies.edit', $cancellation_policy->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('cancellation-policies.destroy', $cancellation_policy->id) }}" method="POST" style="display:inline;">
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