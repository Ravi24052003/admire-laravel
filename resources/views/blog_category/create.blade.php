@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1>Create New Blog Category</h1>
        
        <form action="{{ route('blog-categories.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" required>
                
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('blog-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection