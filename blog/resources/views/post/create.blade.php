@extends('layouts.master')
@section('title')
    editPost
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col col-md-8 text-center">
        <h1 class="">新增文章</h1>
        <form class="form-post" action="{{ route('post.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title" class="sr-only">標題</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="titles" requireds>
            </div>
            <div class="form-group">
                <label for="content" class="sr-only">內文</label>
                <textarea class="form-control" id="content" name="content" rows="10" ></textarea>
            </div>
            <button class="btn btn-primary" type="submit">新增</button>
        </form>
    </div>
</div>

@endsection