<?php

namespace App\Http\Controllers;

use App\Models\ImageAndTextTestimonial;
use App\Http\Requests\StoreImageAndTextTestimonialRequest;
use App\Http\Requests\UpdateImageAndTextTestimonialRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ImageAndTextTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = ImageAndTextTestimonial::all();
        return view('image_and_text_testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('image_and_text_testimonials.create');
    }

    public function store(StoreImageAndTextTestimonialRequest $request)
    {
        $data = $request->validated();
        $directory = public_path('testimonial_images');

        // Handle single image
        if ($request->hasFile('image_file')) {
            $imageFile = $request->file('image_file');
            $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($directory, $imageFilename);
            $data['image'] = 'testimonial_images/' . $imageFilename;
        }

        // Handle multiple images
        if ($request->hasFile("images_files")) {
            $imageFiles = $request->file("images_files");
            $imagesPaths = [];

            foreach ($imageFiles as $imageFile) {
                $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($directory, $imageFilename);
                $imagesPaths[] = 'testimonial_images/' . $imageFilename;
            }

            $data["images"] = $imagesPaths;
        }

        Arr::forget($data, ['image_file', 'images_files']);

        ImageAndTextTestimonial::create($data);

        return redirect()->route('image-and-text-testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function show(ImageAndTextTestimonial $image_and_text_testimonial)
    {
        return view('image_and_text_testimonials.show', compact('image_and_text_testimonial'));
    }

    public function edit(ImageAndTextTestimonial $image_and_text_testimonial)
    {
        return view('image_and_text_testimonials.edit', compact('image_and_text_testimonial'));
    }

    public function update(UpdateImageAndTextTestimonialRequest $request, ImageAndTextTestimonial $image_and_text_testimonial)
    {
        $data = $request->validated();
        $directory = public_path('testimonial_images');

        // Handle single image update
        if ($request->hasFile('image_file')) {
            // Delete old image if it exists
            if ($image_and_text_testimonial->image) {
                $oldImagePath = public_path($image_and_text_testimonial->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageFile = $request->file('image_file');
            $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move($directory, $imageFilename);
            $data['image'] = 'testimonial_images/' . $imageFilename;
        }

        // Handle multiple images update
        if ($request->hasFile("images_files")) {
            // Delete old images if they exist
            if (!empty($image_and_text_testimonial->images)) {
                $oldImages = $image_and_text_testimonial->images;
                foreach ($oldImages as $oldImagePath) {
                    $fullPath = public_path($oldImagePath);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                }
            }

            $imageFiles = $request->file("images_files");
            $imagesPaths = [];

            foreach ($imageFiles as $imageFile) {
                $imageFilename = time() . '_' . uniqid() . Str::random(8) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($directory, $imageFilename);
                $imagesPaths[] = 'testimonial_images/' . $imageFilename;
            }

            $data["images"] = $imagesPaths;
        }

        Arr::forget($data, ['image_file', 'images_files']);

        $image_and_text_testimonial->update($data);

        return redirect()->route('image-and-text-testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(ImageAndTextTestimonial $image_and_text_testimonial)
    {
        // Delete single image
        if ($image_and_text_testimonial->image) {
            $imagePath = public_path($image_and_text_testimonial->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete multiple images
        if (!empty($image_and_text_testimonial->images)) {
            foreach ($image_and_text_testimonial->images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $image_and_text_testimonial->delete();

        return redirect()->route('image-and-text-testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}