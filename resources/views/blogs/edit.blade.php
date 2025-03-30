@extends('dashboard_layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Blog: {{ $blog->blog_title }}</h1>

        {{-- Display All Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <div id="dBBlogData" data-blog-content="{{$blog->blog_content}}"></div> --}}

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-8">

                    <div class="mb-3">
                        <label for="blog_title" class="form-label">Title</label>
                        <input type="text" name="blog_title" id="blog_title" 
                               value="{{ old('blog_title', $blog->blog_title) }}" 
                               class="form-control" required>
                        @error('blog_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_slug" class="form-label">Slug</label>
                        <input type="text" name="blog_slug" id="blog_slug" 
                               value="{{ old('blog_slug', $blog->blog_slug) }}" 
                               class="form-control" required>
                        @error('blog_slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <p id="slugPreview" class="mt-1 text-muted"></p>
                    </div>

                    <div class="mb-3">
                        <label for="blog_description" class="form-label">Description</label>
                        <textarea name="blog_description" id="blog_description" rows="3"
                                  class="form-control">{{ old('blog_description', $blog->blog_description) }}</textarea>
                        @error('blog_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_content" class="form-label">Content</label>
                        <textarea name="blog_content" id="blog_content" rows="10"
                                  class="form-control">{{ old('blog_content', $blog->blog_content) }}</textarea>
                        @error('blog_content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Right Column -->
                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="blog_author_name" class="form-label">Author Name</label>
                        <input type="text" name="blog_author_name" id="blog_author_name" 
                               value="{{ old('blog_author_name', $blog->blog_author_name) }}" 
                               class="form-control">
                        @error('blog_author_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_category" class="form-label">Category</label>
                        <select name="blog_category" id="blog_category" class="form-select">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_name }}" {{($blog->blog_category == $category->category_name)? "selected" :  ''}} >
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_visibility" class="form-label">Visibility</label>
                        <select name="blog_visibility" id="blog_visibility" class="form-select">
                            <option value="public" @if(old('blog_visibility', $blog->blog_visibility) == 'public') selected @endif>Public</option>
                            <option value="private" @if(old('blog_visibility', $blog->blog_visibility) == 'private') selected @endif>Private</option>
                        </select>
                        @error('blog_visibility')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Featured Image -->
                    <div class="mb-3">
                        <label class="form-label">Current Featured Image</label>
                        <div class="border p-2 text-center">
                            <img src="{{ asset($blog->blog_image) }}" alt="{{ $blog->blog_image_alt_text }}" 
                                 class="img-fluid mb-2" style="max-height: 150px;">
                            <p class="small text-muted mb-0">{{ $blog->blog_image_alt_text }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="blog_image_file" class="form-label">Update Featured Image</label>
                        <input type="file" name="blog_image_file" id="blog_image_file" 
                               class="form-control" accept="image/*">
                        @error('blog_image_file')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_image_alt_text" class="form-label">Image Alternative Text</label>
                        <input type="text" name="blog_image_alt_text" id="blog_image_alt_text" 
                               value="{{ old('blog_image_alt_text', $blog->blog_image_alt_text) }}"
                               class="form-control" required>
                        @error('blog_image_alt_text')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Blog Images</h5>
                        </div>
                        <div class="card-body">
                            <!-- Current Gallery Images -->
                            @if($blog->blog_images && count($blog->blog_images))
                                <div class="mb-4">
                                    <div class="row g-2">
                                        @foreach($blog->blog_images as $image)
                                            <div class="col-md-2 col-4">
                                                <div class="position-relative">
                                                    <img src="{{ asset($image) }}" 
                                                         class="img-thumbnail w-100">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Add New Gallery Images -->
                            <div class="mb-3">
                                <label for="blog_images_files" class="form-label">Update Blog Images</label>
                                <input type="file" name="blog_images_files[]" id="blog_images_files" 
                                       class="form-control" multiple accept="image/*">
                                @error('blog_images_files')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- SEO Section -->
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="blog_meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="blog_meta_title" id="blog_meta_title" 
                               value="{{ old('blog_meta_title', $blog->blog_meta_title) }}" 
                               class="form-control">
                        @error('blog_meta_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="blog_meta_keywords" class="form-label">Meta Keywords (comma separated)</label>
                        <input type="text" name="blog_meta_keywords" id="blog_meta_keywords" 
                               value="{{ old('blog_meta_keywords', $blog->blog_meta_keywords) }}" 
                               class="form-control">
                        @error('blog_meta_keywords')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="blog_meta_description" class="form-label">Meta Description</label>
                        <textarea name="blog_meta_description" id="blog_meta_description" rows="3"
                                  class="form-control">{{ old('blog_meta_description', $blog->blog_meta_description) }}</textarea>
                        @error('blog_meta_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Blog
                </button>
                <a href="{{ route('blogs.index') }}" class="btn btn-link text-secondary ms-2">Cancel</a>
                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-info ms-2">
                    <i class="fas fa-eye"></i> Preview
                </a>
            </div>
        </form>
    </div>
@endsection

@section("script")
   <script src="{{asset("js/blog/edit.js")}}"></script>
@endsection