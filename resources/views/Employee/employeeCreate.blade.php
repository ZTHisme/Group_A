@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/employeecrud.css') }}">
@endsection
@section('content')

@if (Session::has('successMessage'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ Session::get('successMessage') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="cardcreate">
  <div class="card-header">
    <h2>New Employee Information</h2>
  </div>
  <div class="card-body">
    <form action="{{ route('addEmployee.post') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label class="form-label">Name : @if ($errors->has('name'))
        <small class="text-danger">*{{ $errors->first('name') }}</small>
        @endif </label><br>
      <input class="form-control" type="name" value="{{ old('name') }}" name="name" placeholder="Enter employee name">
      <br>

      <label class="form-label">Email address : @if ($errors->has('email'))
        <small class="text-danger">*{{ $errors->first('email') }}</small>
        @endif</label><br>
      <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Enter employee email">
      <br>

      <label class="form-label">Password : @if ($errors->has('password'))
        <small class="text-danger">*{{ $errors->first('password') }}</small>
        @endif</label><br>
      <input type="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="Create Passowrd">
      <br>

      <label class="form-label">Confirm Password : @if ($errors->has('confirm_password'))
        <small class="text-danger">*{{ $errors->first('confirm_password') }}</small>
        @endif </label><br>
      <input type="password" value="{{ old('confirm_password') }}" name="confirm_password" class="form-control" placeholder="Confirm Passowrd">
      <br>

      <label class="form-label">Phone : @if ($errors->has('phone'))
        <small class="text-danger">*{{ $errors->first('phone') }}</small>
        @endif </label><br>
      <input type="tel" value="{{ old('phone') }}" name="phone" class="form-control" placeholder="Enter phone number">
      <br>

      <label class="form-label">Address : @if ($errors->has('address'))
        <small class="text-danger">*{{ $errors->first('address') }}</small>
        @endif </label><br>
      <textarea type="address" name="address" class="form-control" placeholder="Enter address">{{ old('address') }}</textarea>
      <br>

      <label for="role" class="form-label">Role : @if ($errors->has('role'))
        <small class="text-danger">*{{ $errors->first('role') }}</small>
        @endif</label><br>
      <select class="form-control" name="role">
        <option value="">Choose Role</option>
        @foreach ($roles as $role)
        @if (old('role') == $role->id)
        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
        @else
        <option value="{{$role->id}}">{{ $role->name }}</option>
        @endif
        @endforeach
      </select>
      <br>

      <label for="department" class="form-label">Department : @if ($errors->has('department'))
        <small class="text-danger">*{{ $errors->first('department') }}</small>
        @endif</label><br>
      <select class="form-control" name="department">
        <option value="">Choose Department</option>
        @foreach ($departments as $department)
        @if (old('department') == $department->id)
        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
        @else
        <option value="{{$department->id}}">{{ $department->name }}</option>
        @endif
        @endforeach
      </select>
      <br>

      <label class="form-label">Leave Fine : @if ($errors->has('leave_fine'))
        <small class="text-danger">*{{ $errors->first('leave_fine') }}</small>
        @endif </label><br>
      <input type="text" value="{{ old('leave_fine') }}" name="leave_fine" class="form-control" placeholder="Enter Leave Fine">
      <br>

      <label class="form-label">OverTime Fee : @if ($errors->has('overtime_fee'))
        <small class="text-danger">*{{ $errors->first('overtime_fee') }}</small>
        @endif</label><br>
      <input type="text" value="{{ old('overtime_fee') }}" name="overtime_fee" class="form-control" placeholder="Enter Overtime Fee">
      <br>

      <label class="form-label">Basic Salary : @if ($errors->has('basic_salary'))
        <small class="text-danger">*{{ $errors->first('basic_salary') }}</small>
        @endif</label><br>
        <input type="text" value="{{ old('basic_salary') }}" name="basic_salary" class="form-control" placeholder="Enter Basic Salary">
        <br>

        @if ($errors->has('profile'))
        <small class="text-danger">*{{ $errors->first('profile') }}</small>
        @endif
        <input type="file" name="profile" class="form-control">
        <br>

        <div class="con-left">
          <input type="submit" value="Add Student" class="btn-add">
        </div>
        <div class="con-right">
          <a href="{{ route('employee#showLists') }}" class="btn-cancel">Cancel</a>
        </div>
        <br>
    </form>
    <br>
  </div>

</div>

@endsection