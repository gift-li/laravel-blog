@extends('layouts.master')
@section('title')
    editPost
@endsection

@section('content')
<form class="row justify-content-center mx-auto" action="{{ route('post.update', $post->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="col text-center">
        <h3 class="py-2 border-bottom border-grey">編輯貼文</h3>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">標題</label>
            
            <div class="col-sm-10">
                <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control-plaintext border border-gre" placeholder="titles" requireds>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">內文</label>
            <div class="col-sm-10">
                <textarea name="content" id="content" rows="10" class="form-control border border-grey">{{ $post->content }}</textarea>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">新增</button>
    </div>
</form>
@endsection