@extends('layouts.master')
@section('title')
    Laravel-Post
@endsection
@section('scripts')
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
@endsection
    
@section('content')
<div class="row w-25 mt-4 d-flex justify-content-between align-items-center mx-auto">
    <h3 class="">最新貼文</h3>
    <a type="button" class="btn btn-info" href="{{ route('post.create') }}" disabled="true">新增文章</a>
</div>
@foreach ($posts as $post)
<div class="row w-100 my-3 mx-0 p-3 bg-white rounded shadow-sm text-muted">
    <dl
        class="list-inline col d-flex align-items-center justify-content-center text-center"
    >
        <dt class="list-inline-item col col-md-1 col-sm-1">
            <svg class="bd-placeholder-img mr-1 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        </dt>
        <dd class="list-inline-item col col-md-9 col-sm-9 m-0">
            <div class="text-left">
                <h3 class="w-100 border-bottom">{{ $post->title }}</h3>
                <div class="content border border-2 rounded p-2">
                    {{ $post->content }}
                </div>
            </div>
        </dd>
        <dd class="list-inline-item col col-md col-sm-3">
        <div class="">
            <a type="button" class="btn btn-outline-primary my-1" href="{{ route('post.show',$post->id ) }}">查看</a>
            <a type="button" class="btn btn-outline-success my-1" href="{{ route('post.edit',$post->id ) }}">編輯</a>
            <form method="POST" action="{{ route('post.destroy',$post->id ) }}">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger my-1" type="submit">刪除</button>
                {{-- <a type="submit" class="btn btn-outline-danger my-1">刪除</a> --}}
            </form>
        </div>
        </dd>
    </dl>
</div>
@endforeach
<div class="row w-100 mb-3 p-3 bg-white rounded shadow-sm text-muted">
    <div class="col text-center">
        <h5 class="text-center mt-3">
            <button type="button" class="btn btn-outline-primary" href="#">全部文章</button>
        </h5>
    </div>
</div>
@endsection