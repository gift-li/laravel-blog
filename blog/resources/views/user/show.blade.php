@extends('layouts.master')
@section('title')
    User-Profile
@endsection

@section('content')
<div class="row w-100 my-3 mx-0 bg-white rounded text-muted">
    <h3 class="w-100 py-3 text-center border-bottom">
        閱覽會員資料
    </h3>
    <dl class="list-inline col d-flex align-items-center justify-content-center my-2 pt-2">
        <dt class="list-inline-item col col-3 border-right border-secondary text-center">
            <h3>姓名</h3>
        </dt>
        <dd class="list-inline-item col col-9 m-0">
            <h4 class="content">{{ $user->name }}</h4>
        </dd>
    </dl>
</div>
<div class="row w-100 my-3 mx-0 bg-white rounded shadow-sm text-muted">
    <dl class="list-inline col d-flex align-items-center justify-content-center my-2">
        <dt class="list-inline-item col col-3 border-right border-secondary text-center">
            <h3>信箱</h3>
        </dt>
        <dd class="list-inline-item col col-9 m-0">
            <p class="content my-2">{{ $user->email }}</p>
        </dd>
    </dl>
</div>
<div class="row w-100 my-3 mx-0 bg-white rounded shadow-sm text-muted">
    <dl class="list-inline col d-flex align-items-center justify-content-center my-2">
        <dt class="list-inline-item col col-3 border-right border-secondary text-center">
            <h3>密碼</h3>
        </dt>
        <dd class="list-inline-item col col-9 m-0">
            <p class="content my-2">{{ $user->password }}</p>
        </dd>
    </dl>
</div>
@endsection