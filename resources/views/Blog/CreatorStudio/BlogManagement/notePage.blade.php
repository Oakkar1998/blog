@extends('Blog.CreatorStudio.layouts.master')

@section('content')
    <div class="">
        <form action="{{ route('creator.createNote') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="">
                <input type="text" name="note" value="{{ $note->note ?? 'Please Enter' }}" placeholder="Enter note..." class="form-control w-100">
                <div class="d-flex justify-content-center mt-2">
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="">
                    <input type="file" name="image" id="">
                    @error('image')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-md btn-dark mx-3">Update</button>
            </div>
        </form>

    </div>
@endsection