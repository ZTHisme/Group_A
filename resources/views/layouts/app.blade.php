<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Group A</title>

  <!-- Styles -->
  <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}">-->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/library/fontawesome.css') }}">
  @yield('css')

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/library/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/library/sweetalert2.min.js') }}"></script>
</head>

<body>

  <div class="wrapper d-flex">
    <nav id="sidebar" class="active">
      <h1><a href="#" class="logo">Employee Management</a></h1>
      <ul class="components">
        <li>
          <a href="#"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-users"></span> Employee List</a>
        </li>
        <li>
          <a href="#"><span class="fas fa-file-invoice"></span> Attendance</a>
        </li>
        <li>
          <a href="#"><span class="fas fa-cash-register"></span> Payroll Management</a>
        </li>
      </ul>
    </nav>
    <!-- Page Content  -->
    <div id="content">
      <nav class="navbar">
        <ul class="navbar-nav">
          <li>
            <img class="profile-img" src="#" id="img">
          </li>
          <li>
            <div class="dropdown">
              <button class="dropbtn btn">Username <i class="fas fa-caret-down"></i></button>
              <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Logout</a>
              </div>
            </div>
          </li>
        </ul>
        <div>
        </div>
      </nav>
      @yield('content')
      @yield('script')
    </div>
  </div>
</body>

</html>