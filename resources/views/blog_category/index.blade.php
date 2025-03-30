@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Blog Categories</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('blog-categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blog_categories as $index=>$category)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="{{ route('blog-categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('blog-categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('blog-categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection