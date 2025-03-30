<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermsAndConditionRequest;
use App\Http\Requests\UpdateTermsAndConditionRequest;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $termsAndConditions = TermsAndCondition::all();
        return view('terms_and_conditions.index', compact('termsAndConditions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('terms_and_conditions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTermsAndConditionRequest $request)
    {
        $data = $request->validated();

        TermsAndCondition::create($request->validated());

        return redirect()->route('terms-and-conditions.index')
                         ->with('success', 'Terms and Policy created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsAndCondition $terms_and_condition)
    {
        return view('terms_and_conditions.show', compact('terms_and_condition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TermsAndCondition $terms_and_condition)
    {
        return view('terms_and_conditions.edit', compact('terms_and_condition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermsAndConditionRequest $request, TermsAndCondition $terms_and_condition)
    {
      $data = $request->validated();

  // Remove empty fields from the data array
  $data = array_filter($data, function ($value) {
    return !empty($value);
});

        $terms_and_condition->update($data);

        return redirect()->route('terms-and-conditions.index')
                         ->with('success', 'Terms and Policy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermsAndCondition $terms_and_condition)
    {
        $terms_and_condition->delete();

        return redirect()->route('terms-and-conditions.index')
                         ->with('success', 'Terms and Policy deleted successfully.');
    }
}
