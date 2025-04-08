<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();

        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('gallery_images');

        DB::transaction(function () use ($request, $directory, $data){
            // if ($request->visibility === 'public') {
            //     Gallery::where('visibility', 'public')->update(['visibility' => 'private']);
            // }

            if ($request->hasFile("images_files")) {
                $image_files = $request->file("images_files");
                $images_paths = [];
    
                foreach ($image_files as $image_file) {
                    $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
    
                    $image_file->move($directory, $image_filename);
    
                    $images_paths[] = 'gallery_images/' . $image_filename;
                }
    
                $data["images"] = $images_paths;
            }
    
            Arr::forget($data, [
                "images_files"
            ]);


            Gallery::create($data);
        });

        return redirect()->route('gallery.index')->with('Gallery images created successfully');
    }

    public function show(Gallery $gallery)
    {
        return view('gallery.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        $directory = public_path('gallery_images');

        DB::transaction(function () use ($request, $data, $gallery, $directory){
            // if ($request->visibility == 'public') {
            //     Gallery::where('visibility', 'public')->update(['visibility' => 'private']);
            // }
           
            $existingImages = $gallery->images ?? [];
    
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
                    $newImagePaths[] = 'gallery_images/' . $imageFilename;
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
            $gallery->update($data);
        });
    
        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if (!empty($gallery->images)) {
            $images = $gallery->images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}
