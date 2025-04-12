<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::all();
        return view('counters.index', compact('counters'));
    }

    public function create()
    {
        return view('counters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'packages' => 'required|integer|min:0',
            'destinations_covered' => 'required|integer|min:0',
            'years_in_business' => 'required|integer|min:0',
            'rating' => 'required|integer|min:1|max:5',
            'visibility' => 'required|in:private,public',
        ]);

        // If this counter is being set to public, make all others private
        if ($request->visibility === 'public') {
            Counter::where('visibility', 'public')->update(['visibility' => 'private']);
        }

        Counter::create($validated);

        return redirect()->route('counters.index')->with('success', 'Counter created successfully.');
    }

    public function show(Counter $counter)
    {
        return view('counters.show', compact('counter'));
    }

    public function edit(Counter $counter)
    {
        return view('counters.edit', compact('counter'));
    }

    public function update(Request $request, Counter $counter)
    {
        $validated = $request->validate([
            'packages' => 'required|integer|min:0',
            'destinations_covered' => 'required|integer|min:0',
            'years_in_business' => 'required|integer|min:0',
            'rating' => 'required|integer|min:1|max:5',
            'visibility' => 'required|in:private,public',
        ]);

        // If this counter is being set to public, make all others private
        if ($request->visibility === 'public') {
            Counter::where('id', '!=', $counter->id)
                   ->where('visibility', 'public')
                   ->update(['visibility' => 'private']);
        }

        $counter->update($validated);

        return redirect()->route('counters.index')->with('success', 'Counter updated successfully.');
    }

    public function destroy(Counter $counter)
    {
        $counter->delete();
        return redirect()->route('counters.index')->with('success', 'Counter deleted successfully.');
    }
}
