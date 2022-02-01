<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Group A</title>

  <link rel="icon" href="{{ asset('images/management .png') }}">
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/library/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/library/jquery.dataTables.min.css') }}">
  @yield('css')

  <!-- Scripts -->
  <script src="{{ asset('js/library/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/library/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/library/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/common.js') }}"></script>
</head>

<body>

  <div class="d-flex">
    <nav id="sidebar">
      <h1><a href="/" class="logo">Employee Management</a></h1>
      <ul>
        <li>
          <a href="{{ route('graph#dashBoard') }}" class="{{ Request::routeIs('graph#dashBoard') ? 'active' : '' }}"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
        </li>
        <li>
          <a href="{{ route('employee#showLists') }}" class="{{ request()->is('employees*') ? 'active' : '' }}"><span class="fa fa-users"></span> Employees</a>
        </li>
        <li>
          <a href="{{ route('attendances#index') }}" class="{{ request()->is('attendances*') ? 'active' : '' }}"><span class="fas fa-file-invoice"></span> Attendance</a>
        </li>
        @can('isManager')
        <li>
          <a href="{{ route('payrolls#index') }}" class="{{ request()->is('payrolls*') ? 'active' : '' }}"><span class="fas fa-cash-register"></span> Payroll Management</a>
        </li>
        @endcan
        <li>
          <a href="{{ route('projects#index') }}" class="{{ request()->is('projects*') ? 'active' : '' }}"><span class="fas fa-tasks"></span> Project Management</a>
        </li>
        @can('isManager')
        <li>
          <a href="{{ route('calendar.upload') }}" class="{{ request()->is('settings*') ? 'active' : '' }}"><span class="far fa-calendar-alt"></span> Add Calendar</a>
        </li>
        @endcan
      </ul>
    </nav>
    <!-- Page Content  -->
    <div id="content">
      <nav class="navbar">
        <ul class="navbar-nav">
          <li>
            <img class="profile-img ipad-profile" src="{{ \Illuminate\Support\Facades\Storage::exists('public/employees/' . auth()->user()->profile) ?
              asset(config('path.profile_path') . auth()->user()->profile) : 
              'https://ui-avatars.com/api/?name='.auth()->user()->name}}" id="img">
          </li>
          <li>
            <div class="dropdown">
              <button class="dropbtn btn ipad-drop"><i class="fas fa-caret-down"> {{ auth()->user()->name }}</i></button>
              <div class="dropdown-content">
                <a class="nav-link" href="{{ route('show.employee.get', [auth()->id()]) }}">&nbsp;&nbsp;Profile</a>
                <a class="nav-link" href="{{ route('logout') }}">&nbsp;&nbsp;Logout</a>
              </div>

            </div>
          </li>
        </ul>
      </nav>

      <!-- Display Errors -->
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
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });

          @if(session('success'))
          Toast.fire({
            icon: 'success',
            title: "{{session('success')}}"
          });
          @endif

          @if(session('task'))
          setTimeout(() => {
            Swal.fire({
              icon: 'info',
              title: 'Alert...',
              text: '{{session('task')}}',
              footer: '<a href="{{ route('projects#index') }}">Go to Project Page...</a>'
            });
          }, 3000);
          @endif
        });
      </script>
    </div>
  </div>
</body>

</html>
