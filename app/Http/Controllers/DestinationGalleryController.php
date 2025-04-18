<?php

namespace App\Http\Controllers;

use App\Models\DestinationGallery;
use App\Http\Requests\StoreDestinationGalleryRequest;
use App\Http\Requests\UpdateDestinationGalleryRequest;
use App\Models\Destination;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DestinationGalleryController extends Controller
{


    public function index(Request $request)
    {

                $query = DestinationGallery::query();


                // Sorting
                $sortBy = $request->input('sort_by', 'id');
                $sortDirection = $request->input('sort_direction', 'desc');
                $query->orderBy($sortBy, $sortDirection);

                // Filters
                if ($request->filled('destination')) {
                $query->where('destination', 'like', '%' . $request->destination . '%');
                }

                if ($request->filled('domestic_or_international')) {
                $query->where('domestic_or_international', $request->domestic_or_international);
                }

                if($request->filled('gallery_type')){
                    $query->where('gallery_type', $request->gallery_type);
                }

                if ($request->filled('visibility')) {
                $query->where('visibility', $request->visibility);
                }

                $galleries = $query->get();


                $type = request()->query('domestic_or_international_get_dstn');
    
                // Fetch destinations based on type
                $destinations = $type 
                    ? Destination::where('domestic_or_international', $type)->get()
                    : collect(); // Empty collection if no type selected

                return view('destination_galleries.index', compact('galleries', 'destinations'));
    }
    // index controller end 



    public function create()
    {

        $type = request()->query('domestic_or_international');
    
        // Fetch destinations based on type
        $destinations = $type 
            ? Destination::where('domestic_or_international', $type)->get()
            : collect(); // Empty collection if no type selected


        return view('destination_galleries.create', compact('destinations', 'type'));
    }
    // create controller end




    public function store(StoreDestinationGalleryRequest $request)
    {
        $data = $request->validated();
        $directory = public_path('destination_galleries');

        if ($request->hasFile("images_files")) {
            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                $image_file->move($directory, $image_filename);
                $images_paths[] = 'destination_galleries/' . $image_filename;
            }

            $data["images"] = $images_paths;

            if(!empty($data["public_images"])) {
                if ($data["public_images"] == "public") {
                    $data["public_images"] = $images_paths;
                } else {
                    $data["public_images"] = [];
                }
            }
        }

        Arr::forget($data, ["images_files"]);
        DestinationGallery::create($data);

        return redirect()->route('destination-galleries.index')
            ->with('success', 'Gallery created successfully.');
    }
    // store controller end



    public function show(DestinationGallery $destination_gallery)
    {
        return view('destination_galleries.show', compact('destination_gallery'));
    }
    // show controller end


    public function edit(DestinationGallery $destination_gallery)
    {
        
        $destination = Destination::where("destination_name", $destination_gallery->destination)->firstOrFail(); // Default type from itinerary

        $type = $destination->domestic_or_international; // Default type from itinerary

        // Get the selected type from request

        if(!empty(request()->query('domestic_or_international'))){
           $type = request()->query('domestic_or_international');
        }


// Fetch destinations based on type

$destinations = $type 
   ? Destination::where('domestic_or_international', $type)->get()
   : collect(); // Empty collection if no type selected
        
        return view('destination_galleries.edit', compact('destination_gallery', 'type', 'destinations'));
    }
// edit controller end



    public function update(UpdateDestinationGalleryRequest $request, DestinationGallery $destination_gallery)
    {
        $data = $request->validated();
        $directory = public_path('destination_galleries');

        // Get existing images
        $existingImages = $destination_gallery->images ?? [];

        // Handle removed images
        $removedImages = [];
        if (!empty($request->input("removed_images"))) {
            $removedImages = json_decode($request->removed_images, true);

            foreach ($removedImages as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                $existingImages = array_filter($existingImages, function ($existingImage) use ($imagePath) {
                    return $existingImage !== $imagePath;
                });
            }

            $existingImages = array_values($existingImages);
        }

        // Handle public images
        $publicImages = [];
        if (!empty($request->input("public_images"))) {
            $publicImages = json_decode($request->public_images, true) ?? [];
        }

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
                $newImagePaths[] = 'destination_galleries/' . $imageFilename;
            }

            $data['images'] = array_merge($existingImages, $newImagePaths);
        } else {
            $data['images'] = $existingImages;
        }

        $data['public_images'] = array_values($publicImages);
        
        Arr::forget($data, ['images_files', 'removed_images']);

        $destination_gallery->update($data);

        return redirect()->route('destination-galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }
    // update controller end

    public function destroy(DestinationGallery $destination_gallery)
    {
        // Delete associated images
        foreach ($destination_gallery->images as $image) {
            $fullPath = public_path($image);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $destination_gallery->delete();
        return redirect()->route('destination-galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
// destroy controller end

}
