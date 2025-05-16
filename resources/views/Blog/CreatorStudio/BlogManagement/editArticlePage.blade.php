@extends('Blog.CreatorStudio.layouts.master')

@section('content')
<main class="container my-5 card">

    <div class="my-3">
        <h2>Update Article</h2>
    </div>

    

    <div class="mb-3">
        <form action="{{ route('creator.editArticle',$article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input name="title" class="form-control" value="{{ old('title',$article->title) }}">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
    
            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input name="author" class="form-control" value="{{ old('author',$article->author) }}">
                @error('author') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category">
                    <option value="" disabled {{ old('category_id',$article->category_id) ? '' : 'selected' }}>Choose Category</option>
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
                <textarea name="content" class="form-control" rows="5">{{ old('content',$article->content) }}</textarea>
                @error('content') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
    
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file"  name="image" class="form-control" 
                onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="d-flex justify-content-center my-5">
                <img src="{{ asset('storage/'.$article->image) }}" id="preview" class="rounded-sm shadow-sm" alt="" width="300" height="300">
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </form>
    </div>

</main>
@endsection