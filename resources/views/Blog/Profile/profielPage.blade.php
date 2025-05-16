@extends('Blog.layouts.master')

@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">Profile Info</div>
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <small>Email: {{$user->email}}</small>
                
            </div>
            <div class="card-footer d-flex justify-content-end ">
                <a href="" class="btn btn-sm btn-dark my-3">update</a>
            </div>
        </div>
    </div>

@endsection