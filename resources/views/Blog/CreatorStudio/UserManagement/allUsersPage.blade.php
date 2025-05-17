@extends('Blog.CreatorStudio.layouts.master')

@section('content')
    <div class="">
        <div class="d-flex justify-content-end mb-3">
            {{ $all_users->links() }}
        </div>
        <table class="table table-hover table-warning">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($all_users->count() != 0)
                    @foreach ($all_users as $users)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration + ($all_users->firstItem() - 1) }}</td>

                            @if ($users->image)
                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $users->image) }}" class="border border-dark rounded-sm"
                                        alt="" width="100" height="auto">
                                </td>
                            @else
                                <td class="align-middle ">
                                    <img src="{{ asset('Photos/noprofile.jpg') }}" class="border border-dark rounded-sm"
                                        alt="" width="100" height="auto">
                                </td>
                            @endif

                            <td class="align-middle">{{ $users->name }}</td>
                            <td class="align-middle">{{ $users->email }}</td>
                            <td class="align-middle">{{ $users->created_at->format('M d, Y') }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $users->id }}">
                                    Delete
                                </button>
                            </td>
                            {{-- delete comfirmation! --}}
                            <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $users->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $users->id }}">Confirm
                                                Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this users:
                                            <strong>{{ $users->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>

                                            <form action="{{ route('profile.deleteUser', $users->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>
                    @endforeach
                @else
                    <div class="">
                        <td colspan="6" class="p-5 text-center h5"> There is no users.</td>
                    </div>
                @endif
            </tbody>
        </table>

    </div>
@endsection
