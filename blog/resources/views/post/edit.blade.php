@extends('layouts.master')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col col-md-8 text-center">
        <h1 class="">編輯文章文章</h1>
        <form class="form-post" action="{{ route('post.update', $post->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="sr-only">標題</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" requireds>
            </div>
            <div class="form-group">
                <label for="content" class="sr-only">內文</label>
                <input type="text" id="content" name="content" class="form-control" value="{{ $post->content }}" requireds>
            </div>
            <button class="btn btn-primary" type="submit">新增</button>
        </form>
    </div>
</div>

@endsection