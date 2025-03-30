<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogContentImageRequest;
use App\Http\Requests\UpdateBlogContentImageRequest;
use App\Models\Blog;
use App\Models\BlogContentImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BlogContentImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = BlogContentImage::all();

        return view('blog-content-image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogs = Blog::all();

        return view('blog-content-image.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogContentImageRequest $request)
    {
        $data = $request->validated();
        $directory = public_path('blog_content_images');

        if ($request->hasFile("images_files")){
            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                $image_file->move($directory, $image_filename);
                $images_paths[] = 'blog_content_images/' . $image_filename; 
            }

            $data["images"] = $images_paths;
        }

        Arr::forget($data, [
            "images_files"
        ]);

        BlogContentImage::create($data);

        return redirect()->route('blogs.index')
        ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view("blog", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view("edit-blog", compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogContentImageRequest $request, BlogContentImage $blogContentImage)
    {
        $data = $request->validated();
        $directory = public_path('blog_content_images');

         // Handle destination_images update
         if ($request->hasFile("images_files")) {
            // Delete old images if they exist
            if (!empty($blogContentImage->images)){
                $oldImages = $blogContentImage->images;
                foreach ($oldImages as $oldImagePath){
                    $fullPath = public_path($oldImagePath);
                    if (file_exists($fullPath)){
                        unlink($fullPath);
                    }
                }
            }

            $image_files = $request->file("images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                $image_file->move($directory, $image_filename);
                $images_paths[] = 'blog_content_images/' . $image_filename;
            }

            $data["images"] = $images_paths;
        }

        Arr::forget($data, [
            "images_files"
        ]);

        $blogContentImage->update($data);

        return response()->json([
            'success' => 'Blog Content Images updated successfully',
            'blog_content_image' => $blogContentImage,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogContentImage $blogContentImage)
    {
        // Delete images if they exist
        if (!empty($blogContentImage->images)) {
            $images = $blogContentImage->images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $blogContentImage->delete();

        return response()->json(['success' => 'blog content images deleted successfully'], 200);
    }
}
