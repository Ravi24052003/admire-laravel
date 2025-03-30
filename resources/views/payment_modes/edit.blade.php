@extends('dashboard_layout.app')

@section('content')
<div class="container">
    <h1>Edit Payment Mode</h1>
    <form action="{{ route('payment-modes.update', $payment_mode->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <select class="form-control" id="domestic_or_international" name="domestic_or_international" required>
                <option value="domestic" {{$payment_mode->domestic_or_international === "domestic" ? 'selected' : '' }} >Domestic</option>
                <option value="international" {{$payment_mode->domestic_or_international === "international" ? 'selected' : ''}}>International</option>
            </select>

            @error('domestic_or_international')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="payment_mode">Payment Mode</label>
            <textarea name="payment_mode" id="payment_mode" class="form-control" required>{{ $payment_mode->payment_mode }}</textarea>
            @error('payment_mode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section("script")
    <script src="{{asset("js/payment_mode/edit.js")}}"></script>
@endsection