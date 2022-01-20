@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/employeecrud.css') }}">
@endsection

@section('content')
<div class="cardcreate">
  <div class="card-header">
    <h2>Edit Employee Information</h2>
  </div>
  <div class="card-body">
    <form action="{{ route('edit.employee.post',$employee->id) }}" method="POST">
      @csrf

      <label class="form-label">Name @if ($errors->has('name'))
        <small class="text-danger">*{{ $errors->first('name') }}</small>
        @endif </label><br>
      <input type="name" name="name" class="form-control" value="{{ $employee->name }}" placeholder="Enter employee name">
      <br>

      <label class="form-label">Email address @if ($errors->has('email'))
        <small class="text-danger">*{{ $errors->first('email') }}</small>
        @endif</label><br>
      <input type="email" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Enter employee email">
      <br>

      <label class="form-label">Phone @if ($errors->has('phone'))
        <small class="text-danger">*{{ $errors->first('phone') }}</small>
        @endif</label><br>
      <input type="tel" name="phone" class="form-control" value="{{ $employee->phone }}" placeholder="Enter employee phone">
        <br>

      <label class="form-label">Choose Role @if ($errors->has('role'))
        <small class="text-danger">*{{ $errors->first('role') }}</small>
        @endif</label><br>
      <select class="form-control" name="role">
        <option value="">Choose Role</option>
        @foreach ($roles as $item)
        @if($employee->role_id == $item->id)
        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
        @endforeach
      </select>
      <br>


      <label class="form-label">Choose Department @if ($errors->has('department'))
        <small class="text-danger">*{{ $errors->first('department') }}</small>
        @endif
      </label><br>
      <select class="form-control" name="department">
        <option value="">Choose Department</option>
        @foreach ($departments as $item)
        @if($employee->department_id == $item->id)
        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
        @endforeach
      </select>


      <div class="con-left">
      <input type="submit" value="Update" class="btn-add">
        </div>
      <div class="con-right">
        <a href="{{ route('employee#showLists') }}" class="btn-cancel">Cancel</a>
      </div>

      <br>
      <br>

  </div>
  </form>
</div>
</div>

@endsection