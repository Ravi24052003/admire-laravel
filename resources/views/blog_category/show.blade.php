@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Blog Category Details</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Category Information</h5>
                <p class="card-text"><strong>ID:</strong> {{ $category->id }}</p>
                <p class="card-text"><strong>Name:</strong> {{ $category->category_name }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $category->created_at->format('M d, Y H:i') }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $category->updated_at->format('M d, Y H:i') }}</p>
                
                <a href="{{ route('blog-categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('blog-categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                </form>
                <a href="{{ route('blog-categories.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection