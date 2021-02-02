@extends('layouts.master')

{{-- Forgot to put tab title --}}

@section('content')
<div class="row justify-content-center">
    <div class="col col-md-6">
        {{-- Input error area is required to let user know what happened to their inputs --}}
        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div><br />
        @endif
        <form class="form-signup text-center" action="{{ route('web.signup') }}" method="POST">
            <h1 class="h3 mb-5 font-weight-normal">註冊</h1>
            {{-- Missed name input --}}
            <div class="form-group">
                <label for="name" class="sr-only">name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="name" required autofocus>
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Email address</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
            </div>
            {{-- Add instruction for password rule --}}
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            {{-- Add this check box only if remember token is build in user table --}}
            {{-- <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div> --}}
            {{-- Remember to change button context --}}
            <button class="btn btn-lg btn-primary btn-block" type="submit">註冊</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection