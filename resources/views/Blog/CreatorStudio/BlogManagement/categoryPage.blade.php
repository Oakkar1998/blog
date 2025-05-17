@extends('Blog.CreatorStudio.layouts.master')

@section('content')
    <div class="">
        <form action="{{ route('creator.createCategory') }}" method="post">
            @csrf
            <div class="d-flex justify-content-center">
                <input type="text" name="name" placeholder="Category Name..." class="form-control w-50">

                <button type="submit" class="btn btn-sm btn-dark mx-3">create</button>

            </div>
            <div class="d-flex justify-content-center mt-2">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </form>

    </div>
    <div class="my-5">
        <div class="d-flex justify-content-end mb-3">
            {{ $categories->links() }}
        </div>
        <table class="table table-warning table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cate)
                    <tr>
                        <td>{{ $loop->iteration + ($categories->firstItem() - 1) }}</td>

                        <td>{{ $cate->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal{{ $cate->id }}">
                                Edit
                            </button>

                            <!-- Edit Button -->
                            @foreach ($categories as $cate)
                                <!-- Modal for Each Category -->
                                <div class="modal fade" id="editCategoryModal{{ $cate->id }}" tabindex="-1"
                                    aria-labelledby="editCategoryModalLabel{{ $cate->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('creator.editCategory', $cate->id) }}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $cate->id }}">
                                                        Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="category_name_{{ $cate->id }}"
                                                            class="form-label">Category Name</label>
                                                        <input type="text" class="form-control"
                                                            id="category_name_{{ $cate->id }}" name="category_name"
                                                            value="{{ $cate->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Delete Button -->
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteCategoryModal{{ $cate->id }}">
                                    Delete
                                </a>

                            @foreach ($categories as $cate)
                                

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteCategoryModal{{ $cate->id }}" tabindex="-1"
                                    aria-labelledby="deleteCategoryModalLabel{{ $cate->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('creator.deleteCategory', $cate->id) }}">
                                            @csrf
                                            @method('DELETE') <!-- Use DELETE if your route expects it -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="deleteCategoryModalLabel{{ $cate->id }}">
                                                        Confirm Delete
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the category:
                                                    <strong>{{ $cate->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
