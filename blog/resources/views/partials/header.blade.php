<nav class="navbar navbar-expand-lg navbar-light bg-light px-2">
  <a class="navbar-brand" href="/"{{-- Without declaring a route name, use url is fine --}}>Brand for no brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto align-items-center">
        @if (Auth::check())
        {{-- admin畫面 --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user" aria-hidden="true"></i> 歡迎回來!~ {{ Auth::user()->name }}{{-- Be careful of the variable name you use --}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a  href="{{ route('user.index') }}" class="dropdown-item">會員資料</a>
              <div class="dropdown-divider"></div>
              <a  href="{{ route('post.index') }}" class="dropdown-item">文章列表</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.logout') }}" class="nav-link btn btn-primary">登出</a>
        </li>
        @else
        {{-- 遊客畫面 --}}
        <li class="nav-item">
          <a href="{{ route('user.signup') }}" class="nav-link">創建帳戶</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.signin') }}" class="btn btn-primary" role="button">登入</a>
        </li>
        @endif
      </ul>
    </div>
</nav>