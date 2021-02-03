@extends('layouts.master')
@section('title')
    MyPost
@endsection
@section('scripts')
@endsection

@section('content')
<div class="row w-100 my-3 mx-0 bg-white rounded text-muted">
    <h3 class="w-100 py-3 text-center border-bottom">
        閱覽貼文
    </h3>
    <dl class="list-inline col d-flex align-items-center justify-content-center my-2 pt-2">
        <dt class="list-inline-item col col-3 border-right border-secondary text-center">
            <h3>標題</h3>
        </dt>
        <dd class="list-inline-item col col-9 m-0">
            <h4 class="content">{{ $post->title }}</h4>
        </dd>
    </dl>
</div>
<div class="row w-100 my-3 mx-0 bg-white rounded shadow-sm text-muted">
    <dl class="list-inline col d-flex align-items-center justify-content-center my-2">
        <dt class="list-inline-item col col-3 border-right border-secondary text-center">
            <h3>內文</h3>
        </dt>
        <dd class="list-inline-item col col-9 m-0">
            <p class="content my-2">{{ $post->content }}</p>
        </dd>
    </dl>
</div>
@endsection