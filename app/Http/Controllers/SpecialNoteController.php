<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialNoteRequest;
use App\Http\Requests\UpdateSpecialNoteRequest;
use App\Models\SpecialNote;
use Illuminate\Http\Request;

class SpecialNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all special notes
        $special_notes = SpecialNote::all();
        return view('special_notes.index', compact('special_notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        return view('special_notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialNoteRequest $request)
    {
        // Validate and store the special note
        SpecialNote::create($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('special-notes.index')
                         ->with('success', 'Special Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialNote $special_note)
    {
        // Return the show view with the special note
        return view('special_notes.show', compact('special_note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialNote $special_note)
    {
        // Return the edit view with the special note
        return view('special_notes.edit', compact('special_note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialNoteRequest $request, SpecialNote $special_note)
    {
        // Validate and update the special note
        $data = $request->validated();

        // Remove empty fields from the data array
        $data = array_filter($data, function ($value) {
            return !empty($value);
        });

        $special_note->update($data);

        // Redirect to the index page with a success message
        return redirect()->route('special-notes.index')
                         ->with('success', 'Special Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialNote $special_note)
    {
        // Delete the special note
        $special_note->delete();

        // Redirect to the index page with a success message
        return redirect()->route('special-notes.index')
                         ->with('success', 'Special Note deleted successfully.');
    }
}