@extends('Blog.layouts.master')

@section('content')

<form action="{{ route('home') }}" method="GET">
    <div class="container">
    {{-- Search Bar --}}
    <div class="my-3 row justify-content-center gx-2">
        <div class="col-12 col-md-6">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Article Name...">
                <button class="btn btn-outline-dark" type="submit">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>


    {{-- Filters --}}
    <div class="container mt-4">
        <div class="row gy-2 justify-content-center">
            {{-- Sort Order --}}
            <div class="col-12 col-md-auto">
                <select class="form-select" name="order" onchange="this.form.submit()">
                    <option value="latest" {{ request('order')=='latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('order')=='oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>

            {{-- Category Filter --}}
            <div class="col-12 col-md-auto">
                <select class="form-select" name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author Filter --}}
            <div class="col-12 col-md-auto">
                <select class="form-select" name="author" onchange="this.form.submit()">
                    <option value="">All Authors</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->author }}" {{ request('author')==$author->author ? 'selected' : '' }}>
                            {{ $author->author }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Reset Button --}}
            <div class="col-12 col-md-auto">
                <a href="{{ route('home') }}" class="btn btn-danger w-100">Reset</a>
            </div>
        </div>
    </div>
</form>






<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @if ($articles->count())
        @foreach ($articles as $article)
        <div class="col">
            <a href="{{ route('article.readArticlePage', $article->id) }}">


                <div class="card h-100 shadow-lg border">
                    <div class="overflow-hidden">
                        @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}"
                            class="card-img-top img-zoomin rounded-top w-100"
                            style="height: 300px; object-fit: cover; object-position: top;" alt="Article Image">
                        @else
                        <img src="{{ asset('news-1.jpg') }}" class="card-img-top img-zoomin rounded-top w-100"
                            style="height: 300px; object-fit: cover; object-position: top;" alt="Default Image">
                        @endif




                    </div>


                    <div class="card-body">
                        <h6 class="card-title mb-3">{{ $article->title }}</h6>

                        <small class="card-title">{{ $article->author }}</small>

                        <small class="text-body-secondary float-end text-dark">{{ $article->created_at->format('M d, Y')
                            }}</small>
                        <p class="card-text mt-3">{{ Str::limit($article->content, 150, '...Read more') }}</p>

                    </div>
                    <div class="card-footer">

                        <div class="d-flex justify-content-between text-muted">
                            <div>
                               


                                <i class="bi bi-eye"></i> {{ $article->views }} Views
                                <small><i class="bi bi-chat-dots ms-3"></i> {{ $article->comments_count }} Comments</small>
                            </div>
                            <div>
                                <small>
                                    <i class="bi bi-heart-fill text-danger"></i>
                                    @if (!empty($article->love) && $article->love > 0)
                                        {{ $article->love }}
                                    @endif
                                </small>
                                

                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        @endforeach


    </div>
    @else
    <div class="">
        <h3 class="text-center p-3">There is no data</h3>
    </div>
    @endif
</div>

<div class="d-flex justify-content-center mt-5">
    {{ $articles->links() }}
</div>




@endsection