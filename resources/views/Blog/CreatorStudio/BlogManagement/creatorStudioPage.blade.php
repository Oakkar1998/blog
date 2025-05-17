@extends('Blog.CreatorStudio.layouts.master')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-center">
            Welcome to Creator Studio Page
        </h1>
        <div class="d-flex justify-content-center">
            <img src="{{ asset('BlogTem/img/welcome.png') }}" alt="" class="w-75 h-25">
        </div>
    </div>
    
@endsection