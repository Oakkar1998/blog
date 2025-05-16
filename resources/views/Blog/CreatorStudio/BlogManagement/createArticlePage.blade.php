@extends('Blog.CreatorStudio.layouts.master')

@section('content')
<main class="container my-5 card">

    <div class="my-3">
        <h2>Create Article</h2>
    </div>

    

    <div class="mb-3">
        <form action="{{ route('article.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input name="title" class="form-control" value="{{ old('title') }}">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
    
            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input name="author" class="form-control" value="{{ old('author') }}">
                @error('author') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Choose Category</option>
                    @foreach ($get_Cate as $cate)
                        <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>
            
            
            
            
    
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                @error('content') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
    
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*"
                    onchange="previewImage(event)">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="d-flex justify-content-center mt-5">
                <img src="{{ asset('Photos/nophotoArticle.jpg') }}" id="preview" class="rounded-sm shadow-lg" width="300" height="300">
            </div>
            <p class="text-center shadow-sm text-dark fw-bold h6 my-3">Preview</p>
            <hr>
            <button type="submit" class="btn btn-dark">Create</button>
        </form>
    </div>

</main>

<script>
    function previewImage(event) {
        const output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection