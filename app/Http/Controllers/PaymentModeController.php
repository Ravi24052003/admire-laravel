<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentModeRequest;
use App\Http\Requests\UpdatePaymentModeRequest;
use App\Models\PaymentMode;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all payment modes
        $payment_modes = PaymentMode::all();
        return view('payment_modes.index', compact('payment_modes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        return view('payment_modes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentModeRequest $request)
    {
        // Validate and store the payment mode
        PaymentMode::create($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('payment-modes.index')
                         ->with('success', 'Payment Mode created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMode $payment_mode)
    {
        // Return the show view with the payment mode
        return view('payment_modes.show', compact('payment_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMode $payment_mode)
    {
        // Return the edit view with the payment mode
        return view('payment_modes.edit', compact('payment_mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentModeRequest $request, PaymentMode $payment_mode)
    {
        // Validate and update the payment mode
        $data = $request->validated();

        // Remove empty fields from the data array
        $data = array_filter($data, function ($value) {
            return !empty($value);
        });

        $payment_mode->update($data);

        // Redirect to the index page with a success message
        return redirect()->route('payment-modes.index')
                         ->with('success', 'Payment Mode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMode $payment_mode)
    {
        // Delete the payment mode
        $payment_mode->delete();

        // Redirect to the index page with a success message
        return redirect()->route('payment-modes.index')
                         ->with('success', 'Payment Mode deleted successfully.');
    }
}