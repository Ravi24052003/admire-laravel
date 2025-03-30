<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = BlogCategory::all();
        return view('blog_category.index', compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:blog_category,category_name|max:255'
        ]);

        BlogCategory::create($request->all());

        return redirect()->route('blog-categories.index')
                         ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('blog_category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('blog_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|unique:blog_category,category_name,'.$id.'|max:255'
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('blog-categories.index')
                         ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('blog-categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}
