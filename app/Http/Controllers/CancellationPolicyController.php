<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCancellationPolicyRequest;
use App\Http\Requests\UpdateCancellationPolicyRequest;
use App\Models\CancellationPolicy;
use Illuminate\Http\Request;

class CancellationPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all cancellation policies
        $cancellationPolicies = CancellationPolicy::all();
        return view('cancellation_policies.index', compact('cancellationPolicies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        return view('cancellation_policies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCancellationPolicyRequest $request)
    {
        // Validate and store the cancellation policy
        CancellationPolicy::create($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('cancellation-policies.index')
                         ->with('success', 'Cancellation Policy created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CancellationPolicy $cancellation_policy)
    {
        // Return the show view with the cancellation policy
        return view('cancellation_policies.show', compact('cancellation_policy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CancellationPolicy $cancellation_policy)
    {
        // Return the edit view with the cancellation policy
        return view('cancellation_policies.edit', compact('cancellation_policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCancellationPolicyRequest $request, CancellationPolicy $cancellation_policy)
    {
        // Validate and update the cancellation policy
        $data = $request->validated();

        // Remove empty fields from the data array
        $data = array_filter($data, function ($value) {
            return !empty($value);
        });

        $cancellation_policy->update($data);

        // Redirect to the index page with a success message
        return redirect()->route('cancellation-policies.index')
                         ->with('success', 'Cancellation Policy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CancellationPolicy $cancellation_policy)
    {
        // Delete the cancellation policy
        $cancellation_policy->delete();

        // Redirect to the index page with a success message
        return redirect()->route('cancellation-policies.index')
                         ->with('success', 'Cancellation Policy deleted successfully.');
    }
}