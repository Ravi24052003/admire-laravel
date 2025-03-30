<?php

namespace App\Http\Controllers;

use App\Models\ItineraryLocationDetailImage;
use App\Http\Requests\StoreItineraryLocationDetailImageRequest;
use App\Http\Requests\UpdateItineraryLocationDetailImageRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ItineraryLocationDetailImageController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $images = ItineraryLocationDetailImage::all();
        return view('itinerary_location_detail_images.index', compact('images'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('itinerary_location_detail_images.create');
    }

    // Store a newly created resource in storage
    public function store(StoreItineraryLocationDetailImageRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('itinerary_location_detail_images');


        if ($request->hasFile("images_files")) {
            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();

                $image_file->move($directory, $image_filename);

                $images_paths[] = 'itinerary_location_detail_images/' . $image_filename;
            }

            $data["images"] = $images_paths;
        }

        Arr::forget($data, [
            "images_files"
        ]);

        ItineraryLocationDetailImage::create($data);

        return redirect()->route('itinerary-location-detail-images.index')
            ->with('success', 'Images uploaded successfully.');
    }

    // Display the specified resource (Route Model Binding)
    public function show(ItineraryLocationDetailImage $itinerary_location_detail_image)
    {
        return view('itinerary_location_detail_images.show', compact('itinerary_location_detail_image'));
    }

    // Show the form for editing the specified resource (Route Model Binding)
    public function edit(ItineraryLocationDetailImage $itinerary_location_detail_image)
    {
        return view('itinerary_location_detail_images.edit', compact('itinerary_location_detail_image'));
    }

    public function update(UpdateItineraryLocationDetailImageRequest $request, ItineraryLocationDetailImage $itinerary_location_detail_image)
    {
        $data = $request->validated();
    
        $directory = public_path('itinerary_location_detail_images');

        // Get existing images
        $existingImages = $itinerary_location_detail_image->images ?? [];

        // Handle removed images
        if (!empty($request->input("removed_images"))) {
            $removedImages = json_decode($request->removed_images, true);
    
            foreach ($removedImages as $imagePath) {
                // Delete the image file from storage
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
    
                // Remove the image path from the array
                $existingImages = array_filter($existingImages, function($existingImage) use ($imagePath) {
                    return $existingImage !== $imagePath;
                });
            }
    
            // Re-index the array
            $existingImages = array_values($existingImages);
        }
    
        // Handle new image uploads
        if ($request->hasFile('images_files')) {
            $imageFiles = $request->file('images_files');
            $newImagePaths = [];
    
            foreach ($imageFiles as $imageFile) {
                $imageFilename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($directory, $imageFilename);
                $newImagePaths[] = 'itinerary_location_detail_images/' . $imageFilename;
            }
    
            // Merge new images with existing images
            $data['images'] = array_merge($existingImages, $newImagePaths);
        } else {
            // If no new images are uploaded, keep the existing images
            $data['images'] = $existingImages;
        }
    
        // Remove temporary fields from the data array
        Arr::forget($data, [
            'images_files',
            'removed_images',
        ]);
    
        // Update the database
        $itinerary_location_detail_image->update($data);
    
        return redirect()->route('itinerary-location-detail-images.index')
            ->with('success', 'Images updated successfully.');
    }
    

    // Remove the specified resource from storage (Route Model Binding)
    public function destroy(ItineraryLocationDetailImage $itinerary_location_detail_image)
    {


          // Delete images if they exist
          if (!empty($itinerary_location_detail_image->images)) {
            $images = $itinerary_location_detail_image->images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $itinerary_location_detail_image->delete();

        return redirect()->route('itinerary-location-detail-images.index')
            ->with('success', 'Images deleted successfully.');
    }
}