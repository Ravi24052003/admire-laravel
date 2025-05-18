<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Http\Requests\StoreFooterRequest;
use App\Http\Requests\UpdateFooterRequest;

class FooterController extends Controller
{
    public function index()
    {
        $footers = Footer::latest()->get();
        return view('footers.index', compact('footers'));
    }

    public function create()
    {
        return view('footers.create');
    }

    public function store(StoreFooterRequest $request)
    {
        $validated = $request->validated();
        
        Footer::create($validated);

        return redirect()->route('footers.index')
            ->with('success', 'Footer created successfully.');
    }

    public function show(Footer $footer)
    {
        return view('footers.show', compact('footer'));
    }

    public function edit(Footer $footer)
    {
        return view('footers.edit', compact('footer'));
    }

    public function update(UpdateFooterRequest $request, Footer $footer)
    {
        $validated = $request->validated();
        
        $footer->update($validated);

        return redirect()->route('footers.index')
            ->with('success', 'Footer updated successfully');
    }

    public function destroy(Footer $footer)
    {
        $footer->delete();

        return redirect()->route('footers.index')
            ->with('success', 'Footer deleted successfully');
    }

}