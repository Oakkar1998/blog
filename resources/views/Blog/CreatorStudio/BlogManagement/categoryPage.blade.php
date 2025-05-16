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
                        data-bs-target="#editCategoryModal" data-category-id="{{ $cate->id }}"
                        data-category-name="{{ $cate->name }}">
                        Edit
                    </button>

                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteCategoryModal" data-category-id="{{ $cate->id }}"
                        data-category-name="{{ $cate->name }}">
                        Delete
                    </a>






                    {{-- <a href="{{ route('creator.deleteCategory',$cate->id) }}"
                        class="btn bnt-sm btn-danger">Delete</a> --}}


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('POST')
                <!-- or PUT if your route expects it -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="category_id" id="modalCategoryId">
                        <div class="mb-3">
                            <label for="modalCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="modalCategoryName" name="category_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the category "<strong id="categoryName"></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteCategoryForm" method="POST" action="" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit Model --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editCategoryModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const categoryId = button.getAttribute('data-category-id');
                const categoryName = button.getAttribute('data-category-name');
        
                const modalCategoryId = editModal.querySelector('#modalCategoryId');
                const modalCategoryName = editModal.querySelector('#modalCategoryName');
                const form = editModal.querySelector('#editCategoryForm');
        
                modalCategoryId.value = categoryId;
                modalCategoryName.value = categoryName;
        
                form.action = `/editCategory/${categoryId}`; // Adjust route if needed
            });
        });
    </script>

    {{-- Delete Model --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll('a[data-bs-toggle="modal"]');
    
    // Add event listeners to each delete button
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get category ID and name from the data attributes
            const categoryId = this.getAttribute('data-category-id');
            const categoryName = this.getAttribute('data-category-name');
            
            // Set the category name in the modal
            document.getElementById('categoryName').innerText = categoryName;
            
            // Set the form action to the correct delete route for the category
            const form = document.getElementById('deleteCategoryForm');
            form.action = `/deleteCategory/${categoryId}`; // Adjust the URL to your delete route
        });
    });
});
    </script>








</div>






@endsection