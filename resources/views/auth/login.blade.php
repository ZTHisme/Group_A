@extends('layouts.design')

@section('title', 'Log In')

@section('content')

<form action="{{ route('login.post') }}" method="POST" class="login-form">
  @csrf
  <!-- Display Alert Messages -->
  {{--@include('common.alert')--}}
  <!-- Display Validation Errors -->
  @include('common.errors')
  <h1 class="login-header">Login</h1>
  <div>
    <input type="text" id="email_address" class="rounded-input @error('email') is-invalid @enderror" name="email" autofocus placeholder="Email">
    @if ($errors->has('email'))
    <span class="error-msg">{{ $errors->first('email') }}</span>
    @endif
  </div>
  <div>
    <input type="password" id="password" class="rounded-input @error('password') is-invalid @enderror" name="password" placeholder="Password">
    @if ($errors->has('password'))
    <span class="error-msg">{{ $errors->first('password') }}</span>
    @endif
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember"> Remember Me
    </label>
  </div>
  <button type="submit" class="">
    Login
  </button>
  <div class="formFooter">
    <a class="underlineHover" href="{{ route('forget.password.get') }}">
      Forget Your Password?
    </a>
  </div>
</form>
@endsection
