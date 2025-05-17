@extends('Blog.CreatorStudio.layouts.master')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        {{ $articles->links() }}
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('creator.createArticlePage') }}" class="btn btn-sm btn-dark">Create</a>
    </div>
    <table class="table table-hover table-warning">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Reactions</th>
                <th>Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($articles->count() > 0)
                @foreach ($articles as $article)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration + ($articles->firstItem() - 1) }}</td>
                        <td class="align-middle text-center">
                            <img src="{{ asset('storage/' . $article->image) }}" class="border border-dark rounded-sm"
                                alt="" width="100" height="auto">
                        </td>
                        <td class="align-middle">{{ Str::limit($article->title, 20, '...') }}
                        </td>
                        <td class="align-middle">{{ $article->author }}</td>
                        <td class="align-middle">
                            <div class="d-flex flex-column gap-1 text-muted small">
                                <span><strong>Viewed:</strong> {{ ($article->views ?? 0) > 99 ? '99+' : ($article->views ?? 0) }}</span>
                                <span><strong>Loved:</strong> {{ ($article->love ?? 0) > 99 ? '99+' : ($article->love ?? 0) }}</span>
                                <span><strong>saved:</strong> {{ ($article->save ?? 0) > 99 ? '99+' : ($article->save ?? 0) }}</span>
                                <span><strong>Commented:</strong> {{ ($article->comments_count ?? 0) > 99 ? '99+' : ($article->comments_count ?? 0) }}</span>
                                <span><strong>Downloaded:</strong> {{ ($article->download_count ?? 0) > 99 ? '99+' : ($article->download_count ?? 0) }}</span>
                            </div>
                        </td>

                        <td class="align-middle">{{ $article->created_at->format('M d, Y') }}</td>

                        <td class="align-middle">
                            <a href="{{ route('creator.viewArticlePage', $article->id) }}"
                                class="btn btn-sm btn-warning">view</a>
                            <a href="{{ route('creator.editArticlePage', $article->id) }}"
                                class="btn btn-sm btn-dark">Edit</a>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $article->id }}">
                                Delete
                            </button>
                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $article->id }}">Confirm
                                                Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this article:
                                            <strong>{{ $article->title }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>

                                            <form action="{{ route('article.deleteArticle', $article->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="7" class="p-5 text-center h5"> There is no data.</td>
            @endif
        </tbody>
    </table>



@endsection
