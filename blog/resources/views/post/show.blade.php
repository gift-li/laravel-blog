@extends('layouts.master')
@section('title')
    Laravel-Post
@endsection
@section('scripts')
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
@endsection

@section('content')
<div class="row justify-content-center align-items-center border">
    <div class="col col-md-10 text-center">
        <div class="row">
            <h3>標題: </h3>
            <span class="title">{{ $post->title }}</span>
        </div>
        <div class="row">
            <h3>內文: </h3>
            <p class="content">{{ $post->content }}</p>
        </div>
    </div>
</div>
@endsection