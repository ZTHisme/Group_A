<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laravel Quickstart - Basic</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
 

</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            @guest
              {{--<li class="nav-item">
                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" 
                  aria-current="page" href="{{ route('login') }}">
                  {{ __('Login') }}
                </a>
              </li>--}}
              {{--<li class="nav-item">
                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" 
                  aria-current="page" href="{{ route('register') }}">
                  {{ __('Register') }}
                </a>
              </li>--}}
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" 
                  data-bs-toggle="dropdown" aria-expanded="false">
                  {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <!-- Display Alert Messages -->
    @include('common.alert')
    <!-- Display Validation Errors -->
    @include('common.errors')
  </div><!-- /.container -->

  @yield('content')
</body>

</html>