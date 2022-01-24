@extends('layouts.app')

@section('title', 'Employee Create')

@section('css')
<link rel="stylesheet" href="{{ asset('css/employee/employeecrud.css') }}">
@endsection

@section('content')

<div class="cardcreate">
  <div class="card-header">
    <h2>New Employee Information</h2>
  </div>
  <div class="card-body">
    <form action="{{ route('addEmployee.post') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row clearfix">
        <div class="float-left text">
          <label for="name">Name</label>
        </div>
        <div class="float-left input">
          <input type="text" name="name" class="form-control" placeholder="Enter employee name">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="email">Email address</label>
        </div>
        <div class="float-left input">
          <input type="email" name="email" class="form-control" placeholder="Enter employee email">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="password">Password</label>
        </div>
        <div class="float-left input">
          <input type="password" name="password" class="form-control" placeholder="Enter password">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="password">Confirm Password</label>
        </div>
        <div class="float-left input">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="phone">Phone</label>
        </div>
        <div class="float-left input">
          <input type="tel" name="phone" class="form-control" placeholder="Enter phone number">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="address">Address</label>
        </div>
        <div class="float-left input">
          <textarea name="address" class="form-control" rows="5" placeholder="Enter address"></textarea>
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="role">Role</label>
        </div>
        <div class="float-left input">
          <select name="role_id" class="form-control">
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="department">Department</label>
        </div>
        <div class="float-left input">
          <select name="department_id" class="form-control">
            @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="leave_fine">Leave Fine</label>
        </div>
        <div class="float-left input">
          <input type="number" name="leave_fine" class="form-control" placeholder="Enter Leave Fine">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="overtime_fee">OverTime Fee</label>
        </div>
        <div class="float-left input">
          <input type="number" name="overtime_fee" class="form-control" placeholder="Enter Overtime Fee">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="basic_salary">Basic Salary</label>
        </div>
        <div class="float-left input">
          <input type="number" name="basic_salary" class="form-control" placeholder="Enter Basic Salary">
        </div>
      </div>

      <div class="row clearfix">
        <div class="float-left text">
          <label for="profile">Profile Picture</label>
        </div>
        <div class="float-left input">
          <input type="file" name="profile" class="form-control" placeholder="Enter Basic Salary" id="profile">
          <img src="" id="preview-profile">
        </div>
      </div>

      <input type="submit" value="Add Student" class="blue-btn">
      <a href="#" id="back" class="red-btn">Cancel</a>
    </form>
    <br>
  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\StoreEmployeeRequest'); !!}
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{ asset('js/employee/create.js') }}"></script>
@endsection