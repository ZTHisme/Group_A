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
  {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/library/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/library/jquery.dataTables.min.css') }}">
  @yield('css')

  <!-- Scripts -->
  {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
  <script src="{{ asset('js/library/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/common.js') }}"></script>
  <script src="{{ asset('js/library/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/library/jquery.dataTables.min.js') }}"></script>
</head>

<body>

  <div class="d-flex">
    <nav id="sidebar">
      <h1><a href="#" class="logo">Employee Management</a></h1>
      <ul>
        <li>
          <a href="{{ route('graph#dashBoard') }}"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
        </li>
        <li>
          <a href="{{ route('employee#showLists') }}"><span class="fa fa-users"></span> Employee List</a>
        </li>
        <li>
          <a href="{{ route('attendances#index') }}"><span class="fas fa-file-invoice"></span> Attendance</a>
        </li>
        @can('isManager')
        <li>
          <a href="{{ route('payrolls#index') }}"><span class="fas fa-cash-register"></span> Payroll Management</a>
        </li>
        @endcan
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
              <button class="dropbtn btn"><i class="fas fa-caret-down"> {{ auth()->user()->name }}</i></button>
              <div class="dropdown-content">
                <a class="nav-link" href="{{ route('show.employee.get', [auth()->id()]) }}">&nbsp;&nbsp;Profile</a>
                <a class="nav-link" href="{{ route('logout') }}">&nbsp;&nbsp;Logout</a>
              </div>

            </div>
          </li>
        </ul>
      </nav>
      <!-- Display Alert Messages -->
      {{--@include('common.alert')--}}
      <!-- Display Validation Errors -->
      @include('common.errors')
      <div class="seprator">
      </div>
      @yield('content')
      @yield('script')
      <script>
        $(function() {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });

          @if (session('success'))
            Toast.fire({
              icon: 'success',
              title: "{{session('success')}}"
            });
          @endif
        });
      </script>
    </div>
  </div>
</body>

</html>