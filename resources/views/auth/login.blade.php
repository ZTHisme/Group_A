@extends('layouts.design')

@section('content')
<main class="login-form">
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">

            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <div class="form-group row mb-3">
                <label for="email_address" class="col-md-4 col-form-label text-md-right">
                  E-Mail Address
                </label>
                <div class="col-md-6">
                  <input type="text" id="email_address" 
                    class="form-control @error('email') is-invalid @enderror" name="email" autofocus>
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                  Password
                </label>
                <div class="col-md-6">
                  <input type="password" id="password" 
                    class="form-control @error('password') is-invalid @enderror" name="password">
                  @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-md-6 offset-md-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Login
                </button>
                <a class="btn btn-success ml-2" href="{{ route('forget.password.get') }}">
                  Forget Your Password?
                </a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection