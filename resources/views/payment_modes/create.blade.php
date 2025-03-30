@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Create Payment Mode</h1>
    <form action="{{ route('payment-modes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <select class="form-control" id="domestic_or_international" name="domestic_or_international" required>
                <option value="domestic">Domestic</option>
                <option value="international">International</option>
            </select>

            @error('domestic_or_international')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <div class="form-group">
            <label for="payment_mode">Payment Mode</label>
            <textarea name="payment_mode" id="payment_mode" class="form-control" required></textarea>
            @error('payment_mode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section("script")
    <script src="{{asset('js/payment_mode/create.js')}}"></script>
@endsection