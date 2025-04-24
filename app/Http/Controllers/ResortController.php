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
        $resorts = Resort::latest()->get();
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
        
        if ($request->hasFile("images_files")) {
            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();

                $image_file->move($directory, $image_filename);

                $images_paths[] = 'resort_images/' . $image_filename;
            }

            $data["images"] = $images_paths;


            if(!empty($data["public_images"])){
                if ($data["public_images"] == "public") {
                    $data["public_images"] = $images_paths;
                } else {
                    $data["public_images"] = [];
                }
            }
        }

        Arr::forget($data, ["images_files"]);

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

         // Get existing images
    $existingImages = $resort->images ?? [];

       // Handle removed images
       $removedImages = [];
       if (!empty($request->input("removed_images"))) {
        $removedImages = json_decode($request->removed_images, true);

        foreach ($removedImages as $imagePath) {
            // Delete the image file from storage
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // Remove the image path from the existing images array
            $existingImages = array_filter($existingImages, function ($existingImage) use ($imagePath) {
                return $existingImage !== $imagePath;
            });
            
        }

        // Re-index the array
        $existingImages = array_values($existingImages);
    }


     // Handle public images
     $publicImages = [];
     if (!empty($request->input("public_images"))) {
         $publicImages = json_decode($request->public_images, true) ?? [];
     }

     // Remove any images from public_images that are also in removed_images

    $publicImages = array_filter($publicImages, function ($image) use ($removedImages) {
        return !in_array($image, $removedImages);
    });

      // Handle new image uploads
      if ($request->hasFile('images_files')) {
        $imageFiles = $request->file('images_files');
        $newImagePaths = [];

        foreach ($imageFiles as $imageFile) {
            $imageFilename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($directory, $imageFilename);
            $newImagePaths[] = 'resort_images/' . $imageFilename;
        }

        // Merge new images with existing images
        $data['images'] = array_merge($existingImages, $newImagePaths);
    } else {
        // If no new images are uploaded, keep the existing images
        $data['images'] = $existingImages;
    }

    $data['public_images'] = array_values($publicImages);


     // Remove temporary fields from the data array
     Arr::forget($data, ['images_files', 'removed_images']);

        $resort->update($data);

        return redirect()->route('resorts.index')->with('success', 'Resort updated successfully.');
    }

    public function destroy(Resort $resort)
    {
          // Delete images if they exist
          if (!empty($resort->images)) {
            $images = $resort->images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $resort->delete();

        return redirect()->route('resorts.index')->with('success', 'Resort deleted successfully.');
    }

    
}
