@extends('layouts.master')
@section('title')
    Laravel-UserList
@endsection
@section('scripts')
@endsection
    
@section('content')
<div class="row w-25 mt-4 d-flex justify-content-center align-items-center mx-auto">
    <h3 class="">會員資料</h3>
    @if (Auth::check())
        <a type="button" class="btn btn-info" href="{{ route('user.create') }}" disabled="true">新增帳號</a>        
    @endif
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
    @endif --}}
</div>
@foreach ($users as $user)
<div class="row w-100 mx-0 bg-white rounded shadow-sm text-muted">
    <dl
        class="list-inline col col-sm-12 d-flex align-items-center justify-content-center text-center"
    >
        <dt class="list-inline-item col col-md-1 col-sm-1">
            <svg class="bd-placeholder-img mr-1 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        </dt>
        @if ($user->role == 'suspend')
        <dd class="list-inline-item col col-md-6 col-sm-6 m-0 text-left">
            <h3 class="border-bottom" style="color: red">停權帳戶</h3>
            <div class="p-2">
                {{ $user->email }}
            </div>
        </dd>
        @else
        <dd class="list-inline-item col col-md-6 col-sm-6 m-0 text-left">
            <h3 class="borderbottom">{{ $user->name }}</h3>
            <div class="p-2">
                {{ $user->email }}
            </div>
        </dd>
        @endif
        <dd class="list-inline-item col col-md col-sm">
        <div class="">
            <a type="button" class="btn btn-outline-primary my-1" href="{{ route('user.show',$user->id ) }}">查看</a>
            <a type="button" class="btn btn-outline-success my-1" href="{{ route('user.edit',$user->id ) }}">編輯</a>
            {{-- <form class="btn p-0" method="POST" action="{{ route('user.destroy',$user->id ) }}">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger my-1" type="submit">刪除</button>
            </form> --}}
            @can('admin')
            @if ($user->role == 'suspend')
            <form class="btn p-0" method="POST" action="{{ route('user.restore',$user->id ) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <button class="btn btn-outline-info my-1" type="submit">復權</button>
            </form>
            @else
            <form class="btn p-0" method="POST" action="{{ route('user.suspend',$user->id ) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-outline-danger my-1" type="submit">停權</button>
            </form>
            @endif
            @endcan
        </div>
        </dd>
    </dl>
</div>
@endforeach
@endsection