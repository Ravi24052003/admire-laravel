@extends('dashboard_layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Resorts</h1>
        <a href="{{ route('resorts.create') }}" class="btn btn-primary">Create Resort</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>S no.</th>
                <th>Title</th>
                <th>Visibility</th>
                <th>Discount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resorts as $index=>$resort)
                <tr>
                    <td>
                       {{$index + 1}}
                    </td>
                    <td>{{ $resort->title }}</td>
                    <td>{{ $resort->visibility ? 'Visible' : 'Hidden' }}</td>
                    <td>{{ $resort->discount ? $resort->discount.'%' : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('resorts.show', $resort) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('resorts.edit', $resort) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('resorts.destroy', $resort) }}" method="POST" class="d-inline">
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