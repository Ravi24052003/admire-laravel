<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResortRequest;
use App\Http\Requests\UpdateResortRequest;
use App\Models\Resort;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ResortController extends Controller
{
    public function index()
    {
        $resorts = Resort::all();
        return view('resorts.index', compact('resorts'));
    }

    public function create()
    {
        return view('resorts.create');
    }

    public function store(StoreResortRequest $request)
    {
        $data = $request->validated();
        $directory = public_path('resort_images');
        
        if ($request->hasFile("image_file")) {
            $imageFile = $request->file("image_file");
            $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($directory, $imageFilename);
            $data["image"] = 'resort_images/' . $imageFilename;
        }

        Arr::forget($data, ["image_file"]);

        Resort::create($data);

        return redirect()->route('resorts.index')->with('success', 'Resort created successfully.');
    }

    public function show(Resort $resort)
    {
        return view('resorts.show', compact('resort'));
    }

    public function edit(Resort $resort)
    {
        return view('resorts.edit', compact('resort'));
    }

    public function update(UpdateResortRequest $request, Resort $resort)
    {
        $data = $request->validated();
        $directory = public_path('resort_images');
        
        if ($request->hasFile("image_file")) {
            if ($resort->image && file_exists(public_path($resort->image))) {
                unlink(public_path($resort->image));
            }

            $imageFile = $request->file("image_file");
            $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($directory, $imageFilename);
            $data["image"] = 'resort_images/' . $imageFilename;
        }

        Arr::forget($data, ["image_file"]);

        $resort->update($data);

        return redirect()->route('resorts.index')->with('success', 'Resort updated successfully.');
    }

    public function destroy(Resort $resort)
    {
        if ($resort->image && file_exists(public_path($resort->image))) {
            unlink(public_path($resort->image));
        }

        $resort->delete();

        return redirect()->route('resorts.index')->with('success', 'Resort deleted successfully.');
    }

    
}
