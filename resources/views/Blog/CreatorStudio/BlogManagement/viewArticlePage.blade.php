@extends('Blog.CreatorStudio.layouts.master')

@section('content')
<main>
    <div class="">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('storage/'.$article->image) }}" class="shadow-lg img-thumbnail shake-effect"
                alt="Article Image" width="400" height="400">
        </div>
    </div>
    <div class="container my-5">
        <div class="card shadow-sm">

            



            <div class="card-body">
                <h1 class="card-title text-center mt-5">{{ $article->title }}</h1>
                
                <div class="d-flex justify-content-between align-items-center my-3">
                    <small class="text-body-secondary">{{ $article->created_at->format('M d, Y') }}</small>
                    <h5 class=" ">{{ $article->author }}</h5>
                
                    
                </div>
                
                <hr>
                
                @foreach(preg_split("/\r\n|\n|\r/", $article->content) as $paragraph)
                @if(trim($paragraph))
                <p class="lh-lg mt-3" style="text-indent: 2em;">{{ $paragraph }}</p>
                @endif
                @endforeach

                

                <hr>

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
        </div>
    </div>
</main>
@endsection