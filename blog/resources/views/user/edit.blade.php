@extends('layouts.master')

@section('content')
<form class="row justify-content-center mx-auto" action="{{ route('user.update', $user->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="col text-center">
        <h3 class="py-2 border-bottom border-grey">編輯會員資料</h3>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control-plaintext border border-gre" placeholder="name" requireds>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">信箱</label>
            <div class="col-sm-10">
                <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control-plaintext border border-gre" placeholder="email" requireds>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">密碼</label>
            <div class="col-sm-10">
                <input type="text" id="password" name="password" value="{{ $user->password }}" class="form-control-plaintext border border-gre" placeholder="password" requireds>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">更新</button>
    </div>
</form>
@endsection