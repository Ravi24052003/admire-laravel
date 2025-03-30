@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h1>Blog Posts</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                    Create New Blog Post
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Visibility</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $index=>$blog)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{ Str::limit($blog->blog_title, 30) }}</td>
                                    <td>{{ Str::limit($blog->blog_slug, 20) }}</td>
                                    <td>{{ $blog->blog_category }}</td>
                                    <td>{{ $blog->blog_author_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $blog->blog_visibility === 'public' ? 'success' : 'warning' }}">
                                            {{ ucfirst($blog->blog_visibility) }}
                                        </span>
                                    </td>
                                    <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this blog post?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No blog posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection