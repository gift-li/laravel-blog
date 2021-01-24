@extends('layouts.master')
@section('title')
    Laravel-Post
@endsection
@section('scripts')
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col col-md-4 text-center">
        <h1>文章列表</h1>
        <a href="{{ route('post.create') }}" class="btn btn-primary">新增文章</a>
    </div>
    <table class="table border border-black">
      <td class="border border-black">標題</td>
      <td class="border border-black">內容</td>
      <td class="border border-black">動作</td>
      @foreach($posts as $post)
      <tr class="border border-black">
          <td class="border border-black">{{ $post->title }}</td>
          <td class="border border-black">{{ $post->content }}</td>
          <td class="border border-black">
              <a href="{{ route('post.show',$post->id ) }}">查看</a>
              <a href="{{ route('post.edit',$post->id ) }}">編輯</a>
              <a href="{{ route('post.destroy',$post->id ) }}">刪除</a>
          </td>
      </tr>
      @endforeach
  </table>
</div>
@endsection