@extends('Blog.layouts.master')

@section('content')

<form action="{{ route('home') }}" method="GET">
    <div class="container">
        <div class="my-3 d-flex justify-content-center">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-auto"
                placeholder="Article Name...">
            <button class="btn btn-outline-dark mx-2" type="submit">
                Search
            </button>
        </div>
    </div>
    <div class="container mt-5 d-flex justify-content-evenly">
        {{-- Sort Order --}}
        <select class="form-select w-auto" name="order" onchange="this.form.submit()">
            <option value="latest" {{ request('order')=='latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('order')=='oldest' ? 'selected' : '' }}>Oldest</option>
        </select>

        {{-- Category Filter --}}
        <select class="form-select w-auto" name="category" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        {{-- Author Filter --}}
        <select class="form-select w-auto" name="author" onchange="this.form.submit()">
            <option value="">All Authors</option>
            @foreach ($authors as $author)
            <option value="{{ $author->author }}" {{ request('author')==$author->author ? 'selected' : '' }}>
                {{ $author->author }}
            </option>
            @endforeach
        </select>

        <div class="">
            <a href="{{route('home')}}" class="btn btn-danger">reset</a>
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

<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 ">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest News End -->

<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest-news-item">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="{{ asset('BlogTem/img/news-7.jpg') }}" class="img-zoomin img-fluid rounded-top w-100"
                            alt="">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 ">Lorem Ipsum is simply dummy text of...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-body link-hover">by Willum Skeem</a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection