@extends('layouts.master')
@section('title')
    Laravel-Post
@endsection
@section('scripts')
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
@endsection
    
@section('content')
<div class="row w-25 mt-4 d-flex justify-content-center align-items-center mx-auto">
    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
    @endif
    <h3 class="">最新貼文</h3>
</div>
@foreach ($posts as $post)
<div class="row w-100 mx-0 my-1 bg-white rounded shadow-sm text-muted">
    <dl
        class="list-inline col col-12 d-flex align-items-center justify-content-center text-center"
    >
        <dt class="list-inline-item col col-md-1 d-none d-sm-block d-sm-none d-md-block">
            <svg class="bd-placeholder-img mr-1 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        </dt>
        <dd class="list-inline-item col col-10 m-0 p-0">
            <div class="text-left">
                <h3 class="w-100 border-bottom">{{ $post->title }}</h3>
                <div class="content border border-2 rounded p-2">
                    {{ $post->content }}
                </div>
            </div>
        </dd>
    </dl>
</div>
@endforeach
{{-- <div class="row w-100 mb-3 p-3 bg-white rounded shadow-sm text-muted">
    <div class="col text-center">
        <h5 class="text-center mt-3">
            <button type="button" class="btn btn-outline-primary" href="#">全部文章</button>
        </h5>
    </div>
</div> --}}
@endsection