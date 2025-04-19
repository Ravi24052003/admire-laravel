<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationImageRequest;
use App\Http\Requests\UpdateDestinationImageRequest;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DestinationImageController extends Controller
{
    // Display a listing of the resource
    public function index()
    {

        // if(!empty(request()->input('destination_type'))){
        //     if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
        //         $images = DestinationImage::whereJsonContains('destination_type', ['weekend_gateway'])->latest()->get();
        //         return view('weekend_gateway.index', compact('images'));
        //     }
        // }

        // $trendingImageIds = DestinationImage::whereJsonContains('destination_type', ['weekend_gateway'])->pluck('id');

        // $images = DestinationImage::whereNotIn('id', $trendingImageIds)->latest()->get();

        $images = DestinationImage::latest()->get();
        
        return view('destination_image.index', compact('images'));        
    }

    // Show the form for creating a new resource
    public function create()
    {
        // if(!empty(request()->input('destination_type'))) {
        // if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
        //     $destination_type = request()->input('destination_type');
        //     $destinations = Destination::where('domestic_or_international', "domestic")->get();

        //     return view('weekend_gateway.create', compact('destination_type', 'destinations'));
        // }
        // }

        $type = request()->query('domestic_or_international');
    
        // Fetch destinations based on type
        $destinations = $type 
            ? Destination::where('domestic_or_international', $type)->get()
            : collect(); // Empty collection if no type selected

        return view('destination_image.create', compact('destinations',
            'type'));
    }

    // Store a newly created resource in storage
    public function store(StoreDestinationImageRequest $request)
    {
        $data = $request->validated();

        if(!empty($data["destination_type"])){
         $data["destination_type"] = json_decode($data["destination_type"]);
        }

        $directory = public_path('destination_images');

        if ($request->hasFile("images_files")) {
            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();

                $image_file->move($directory, $image_filename);

                $images_paths[] = 'destination_images/' . $image_filename;
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

        Arr::forget($data, [
            "images_files"
        ]);

        DestinationImage::create($data);

        // if(!empty($data["destination_type"])){
        //     return redirect()->route('destination-images.index', ['destination_type' => $data["destination_type"]])
        //         ->with('success', 'Images uploaded successfully.');
        //    }

        return redirect()->route('destination-images.index')
            ->with('success', 'Images uploaded successfully.');
    }

    // Display the specified resource (Route Model Binding)
    public function show(DestinationImage $destination_image)
    {
        // if(!empty($destination_image->destination_type)){
        //     if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
        //         return view('weekend_gateway.show', compact('destination_image'));
        //     }
        // }

        return view('destination_image.show', compact('destination_image'));
    }

    // Show the form for editing the specified resource (Route Model Binding)
    public function edit(DestinationImage $destination_image)
    {
        // if(!empty(request()->input("destination_type"))){
        //     if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
        //         $destination_type = request()->input("destination_type");
        //         $destinations = Destination::where('domestic_or_international', "domestic")->get();
    
        //         return view('weekend_gateway.edit', compact('destination_image', 'destination_type', 'destinations'));
        //     }
        // }

        $destination = Destination::where("destination_name", $destination_image->destination)->firstOrFail(); // Default type from itinerary

        $type = $destination->domestic_or_international; // Default type from itinerary

        // Get the selected type from request

        if(!empty(request()->query('domestic_or_international'))){
           $type = request()->query('domestic_or_international');
        }


// Fetch destinations based on type

$destinations = $type 
   ? Destination::where('domestic_or_international', $type)->get()
   : collect(); // Empty collection if no type selected

        return view('destination_image.edit', compact('destination_image', 'destinations', 'type'));
    }


public function update(UpdateDestinationImageRequest $request, DestinationImage $destination_image)
{
    $data = $request->validated();

    if(!empty($data["destination_type"])){
        $data["destination_type"] = json_decode($data["destination_type"]);
       }

    $directory = public_path('destination_images');

    // Get existing images
    $existingImages = $destination_image->images ?? [];

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
            $newImagePaths[] = 'destination_images/' . $imageFilename;
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

    // Update the database
    $destination_image->update($data);

    // if(!empty(request()->input('destination_type'))){
    //     if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
    //         return redirect()->route('destination-images.index', ['destination_type'=> 'weekend_gateway'])
    //         ->with('success', 'Images updated successfully.');
    //     }
    //    }

    return redirect()->route('destination-images.index')
        ->with('success', 'Images updated successfully.');
}

    
    

    // Remove the specified resource from storage (Route Model Binding)
    public function destroy(DestinationImage $destination_image)
    {

          // Delete images if they exist
          if (!empty($destination_image->images)) {
            $images = $destination_image->images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $destination_image->delete();

        //    if(!empty(request()->input('destination_type'))){
        //     if((request()->input("destination_type") == ["weekend_gateway"]) || (request()->input("destination_type") == "weekend_gateway") ){
        //         return redirect()->route('destination-images.index', ['destination_type'=> 'weekend_gateway'])
        //         ->with('success', 'Images updated successfully.');
        //     }
        //    }


        return redirect()->route('destination-images.index')
            ->with('success', 'Images deleted successfully.');
    }

    
}