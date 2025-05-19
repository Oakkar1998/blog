@extends('Blog.layouts.master')

@section('content')
    <main>

        <div class="mt-3">
            <div class="d-flex justify-content-center">
                <div class="">
                    <img src="{{ asset('storage/' . $article->image) }}" class="shadow-lg img-thumbnail shake-effect"
                        alt="Article Image" width="400" height="400">

                </div>
            </div>
        </div>


        <div class="container my-5">
            <div class="card shadow-sm">





                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('article.loveArticle', $article->id) }}" class="btn btn-outline-warning">
                            <i class="fa-solid fa-heart" style="color: #fa0000;"></i>
                        </a>
                        <a href="{{ route('article.saveArticle', $article->id) }}" class="btn btn-outline-dark">
                            <i class="fa-solid fa-bookmark" style="color: #FFD43B;"></i>
                        </a>
                        <a href="{{ route('article.pdf',$article->id) }}" class="btn btn-outline-dark">
                            <i class="fa-solid fa-download" style="color: #0de94f;"></i>
                        </a>

                    </div>
                    <h1 class="card-title text-center mt-5">{{ $article->title }}</h1>

                    <div class="d-flex justify-content-between align-items-center my-3">
                        <small class="text-body-secondary">{{ $article->created_at->format('M d, Y') }}</small>
                        <h5 class=" ">{{ $article->author }}</h5>


                    </div>

                    <hr>

                    @foreach (preg_split("/\r\n|\n|\r/", $article->content) as $paragraph)
                        @if (trim($paragraph))
                            <p class="lh-lg mt-3" style="text-indent: 2em;">{{ $paragraph }}</p>
                        @endif
                    @endforeach



                    <hr>

                    <div class="d-flex justify-content-between text-muted">
                        <div>


                            <i class="bi bi-eye"></i> {{ $article->views }} Views

                            <i class="bi bi-chat-dots ms-3"></i> {{ $article->comments_count }} Comments
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
        <div class="container my-3">
            @auth
                <form method="POST" action="{{ route('article.commentArticle', $article->id) }}">
                    @csrf
                    <textarea name="content" rows="3" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-dark mt-2 float-end">Comment</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Login</a> to post a comment.</p>
            @endauth
        </div>

        <div class="container my-3">
            <h5 class="mb-3">{{ $article->comments_count }} Comment{{ $article->comments_count !== 1 ? 's' : '' }}</h5>

            @forelse ($article->comments as $comment)
                <div class="mb-3 border-bottom pb-2 d-flex align-items-start">
                    {{-- Optional user avatar --}}
                    <div class="me-3">
                        <div class="rounded-circle bg-secondary text-white text-center"
                            style="width: 40px; height: 40px; line-height: 40px;">
                            {{ strtoupper(substr(optional($comment->user)->name ?? '?', 0, 1)) }}
                        </div>
                    </div>

                    <div>
                        <strong class="text-dark">
                            {{ $comment->user->name ?? 'Unknown User' }}
                            @if ($comment->user_id == $article->user_id)
                                <small class="text-primary">(Author)</small>
                            @endif
                        </strong>

                        <small class="text-muted d-block">{{ $comment->created_at->diffForHumans() }}</small>
                        <p class="mb-1 mt-1">{{ $comment->content }}</p>
                    </div>


                    <!-- Edit Button -->
                    @auth
                        @if ($comment->user_id == auth()->id())
                            <button type="button" class="btn btn-sm btn-outline-warning mx-2" data-bs-toggle="modal"
                                data-bs-target="#editCommentModal{{ $comment->id }}">
                                <i class="fa fa-pen"></i>
                            </button>
                        @endif
                    @endauth


                    <!-- Delete Button -->
                    @auth
                        @if ($comment->user_id == auth()->id() || $article->user_id == auth()->id())
                            <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal"
                                data-bs-target="#deleteCommentModal{{ $comment->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1"
                            aria-labelledby="editCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('article.editComment', $comment->id) }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCommentModalLabel{{ $comment->id }}">Edit Comment
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="content" class="form-control" rows="4" required>{{ $comment->content }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endauth



                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteCommentModal{{ $comment->id }}" tabindex="-1"
                        aria-labelledby="deleteCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form method="POST" action="{{ route('article.deleteComment', $comment->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCommentModalLabel{{ $comment->id }}">Confirm
                                            Deletion
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this comment?<br>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="border border-dark rounded p-3 text-center">
                    <h5 class="m-0">There are no comments yet.</h5>
                </div>
            @endforelse
        </div>



    </main>
@endsection
