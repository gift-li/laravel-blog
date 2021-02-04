@extends('layouts.master')
@section('title')
    PostList
@endsection
    
@section('content')
<div class="row w-25 my-4 d-flex justify-content-center align-items-center mx-auto">
    <h3 class="">最新貼文</h3>
    @if (Auth::check())
        <a type="button" class="btn btn-info" href="{{ route('post.create') }}" disabled="true">新增文章</a>
    @endif
</div>
@foreach ($posts as $post)
<div class="row w-100 mx-0 bg-white rounded shadow-sm text-muted">
    <dl
        class="list-inline col col-12 d-flex align-items-center justify-content-center text-center"
    >
        <dt class="list-inline-item col col-md-1 d-none d-sm-block d-sm-none d-md-block">
            <svg class="bd-placeholder-img mr-1 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        </dt>
        <dd class="list-inline-item col col-md-8 col-sm-10 m-0">
            <div class="text-left">
                <h3 class="w-100 border-bottom">{{ $post->title }}</h3>
                <div class="content border border-2 rounded p-2">
                    {{ $post->content }}
                </div>
            </div>
        </dd>
        <dd class="list-inline-item col col-md col-sm">
            <div class="">
                <a type="button" class="btn btn-outline-primary my-1" href="{{ route('post.show',$post->id ) }}">查看</a>
                <a type="button" class="btn btn-outline-success my-1" href="{{ route('post.edit',$post->id ) }}">編輯</a>
                <form method="POST" action="{{ route('post.destroy',$post->id ) }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-danger my-1" type="submit">刪除</button>
                </form>
            </div>
        </dd>
    </dl>
</div>
@endforeach
@endsection