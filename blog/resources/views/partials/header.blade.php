<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('shop.index') }}">Brand for no brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item active">
          <a class="nav-link" href="#"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Shopping Cart <span class="sr-only">(current)</span></a>
        </li>
        {{-- 權限介面分流: 待處理 --}}
        @if (Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user" aria-hidden="true"></i> User Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a  href="{{ route('user.profile') }}" class="dropdown-item">Profile</a>
              <div class="dropdown-divider"></div>
              <a  href="{{ route('user.logout') }}" class="dropdown-item btn-primary">Logout</a>
          </div>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('user.signin') }}" class="dropdown-item">LogIn</a>
        </li>            
        <li class="nav-item">
          <a href="{{ route('user.signup') }}" class="btn btn-primary" role="button">Signup!</a>
        </li>
        @endif
      </ul>
    </div>
</nav>