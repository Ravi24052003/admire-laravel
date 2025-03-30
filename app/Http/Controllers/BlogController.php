<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogContentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();

        return view('blogs.create', compact('categories'));
    }

   
    public function store(StoreBlogRequest $request)
    {

        $data = $request->validated();

        $data["user_id"] = Auth::id();

        $directory = public_path('blog_images');
        // Handle the image upload
        if ($request->hasFile('blog_image_file')) {
            $blog_image_file = $request->file("blog_image_file");
          
            $blog_image_filename = time() . '_' . uniqid(). Str::random(8) . '.' . $blog_image_file->getClientOriginalExtension();

            $blog_image_file->move($directory, $blog_image_filename);

            $data["blog_image"] = 'blog_images/' . $blog_image_filename;
        }


        if ($request->hasFile("blog_images_files")) {
            $image_files = $request->file("blog_images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                $image_file->move($directory, $image_filename);
                $images_paths[] = 'blog_images/' . $image_filename;
            }

            $data["blog_images"] = $images_paths;
        }

        // Remove 'blog_image_file' field
        Arr::forget($data, ['blog_image_file', 'blog_images_files']);

        Blog::create($data);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }




    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {   
        $categories = BlogCategory::all();
        
        $blogContentImage = BlogContentImage::where("blog_slug", $blog->blog_slug)->first();

        return view('blogs.edit', compact('blog', 'categories', 'blogContentImage'));
    }


    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        $directory = public_path('blog_images');
        // Handle the image upload
        if ($request->hasFile('blog_image_file')){
            // Delete the old image if it exists
            if (!empty($blog->blog_image)) {
                $oldBlogImage = public_path($blog->blog_image);

                if(file_exists($oldBlogImage)){
                    unlink($oldBlogImage);
                }
            }

            $blog_image_file = $request->file("blog_image_file");
          
            $blog_image_filename = time() . '_' . uniqid(). Str::random(8) . '.' . $blog_image_file->getClientOriginalExtension();

            $blog_image_file->move($directory, $blog_image_filename);

            $data["blog_image"] = 'blog_images/' . $blog_image_filename;
        }


         // Handle blog_images update
         if ($request->hasFile("blog_images_files")) {
            // Delete old images if they exist
            if (!empty($blog->blog_images)) {
                $oldImages = $blog->blog_images;
                foreach ($oldImages as $oldImagePath) {
                    $fullPath = public_path($oldImagePath);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                }
            }

            $image_files = $request->file("blog_images_files");
            $images_paths = [];

            foreach ($image_files as $image_file) {
                $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                $image_file->move($directory, $image_filename);
                $images_paths[] = 'blog_images/' . $image_filename;
            }

            $data["blog_images"] = $images_paths;
        }

        // Remove 'blog_image_file' field
        Arr::forget($data, ['blog_image_file', 'blog_images_files']);

        $blog->update($data);

        return redirect()->route('blogs.show', $blog->id)
        ->with('success', 'Blog updated successfully.');
    }


    public function destroy(Blog $blog)
    {
        if (!empty($blog->blog_image)) {
            $oldBlogImage = public_path($blog->blog_image);

            if(file_exists($oldBlogImage)){
                unlink($oldBlogImage);
            }
        }


        if (!empty($itinerary->blog_images)) {
            $images = $blog->blog_images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }


        $blog->delete();

        
        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
