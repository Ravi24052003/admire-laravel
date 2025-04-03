<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $query = Destination::query();
    
    // Apply filter if requested
    if ($request->has('type') && in_array($request->type, ['domestic', 'international'])) {
        $query->where('domestic_or_international', $request->type);
    }
    
    $destinations = $query->latest()->get();
    
    return view('destinations.index', [
        'destinations' => $destinations,
        'currentFilter' => $request->type ?? null
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domestic_or_international' => 'required|in:domestic,international',
            'destination_name' => 'required|string|max:255|unique:destinations,destination_name',
        ]);

        

        Destination::create($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'domestic_or_international' => 'required|in:domestic,international',
            'destination_name' => 'required|string|max:255|unique:destinations,destination_name,'.$destination->id,
        ]);

        $destination->update($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}