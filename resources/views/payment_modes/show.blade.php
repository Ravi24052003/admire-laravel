@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Payment Mode Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Domestic or International: {{ $payment_mode->domestic_or_international }}</h5>
            <p class="card-text"><strong>Payment Mode:</strong> {!! $payment_mode->payment_mode !!}</p>
            <a href="{{ route('payment-modes.edit', $payment_mode->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('payment-modes.destroy', $payment_mode->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection