@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col col-md-4 text-center">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div><br />
        @endif --}}
        <form class="form-signup" action="{{ route('user.signup') }}" method="POST">
            <h1 class="h3 mb-5 font-weight-normal">Sign up</h1>
            <div class="form-group">
                <label for="email" class="sr-only">Email address</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection