@extends('layouts.master')
@section('title')
    createAccount
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col col-md-8">
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div><br />
        @endif
        <h1 class="text-center py-2 my-2 border-bottom">新增帳號</h1>
        <form class="form-post text-center" action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title" class="sr-only">姓名</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="name" requireds>
            </div>
            <div class="form-group">
                <label for="content" class="sr-only">信箱</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="email" requireds>
            </div>
            <div class="form-group">
                <label for="content" class="sr-only">密碼</label>
                <input type="text" id="password" name="password" class="form-control" placeholder="password" requireds> {{-- Be care of the type --}}
            </div>
            <button class="btn btn-primary" type="submit">創建管理者帳號</button>
        </form>
    </div>
</div>

@endsection