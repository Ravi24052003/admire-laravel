@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Payment Modes</h1>
    <a href="{{ route('payment-modes.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S no.</th>
                <th>Domestic or International</th>
                <th>Payment Mode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payment_modes as $index=>$payment_mode)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $payment_mode->domestic_or_international }}</td>
                    <td>{!! Str::limit($payment_mode->payment_mode, 50) !!}</td>
                    <td>
                        <a href="{{ route('payment-modes.show', $payment_mode->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('payment-modes.edit', $payment_mode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('payment-modes.destroy', $payment_mode->id) }}" method="POST" style="display:inline;">
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