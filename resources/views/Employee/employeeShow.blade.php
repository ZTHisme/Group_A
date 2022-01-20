@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/employeecrud.css') }}">
@endsection
@section('content')
<div class="container">
  <div class="title">
    <h5> {{ $employee->name }}'s Information</h5>
  </div>
  <div>
    <div class="card">
      <img class="profile-img" src="{{ asset('uploads/employees/' . $employee->profile) }}" />
      <div class="container">
        <h4><b>
            <p>Name : {{ $employee->name }}
            <p>
          </b></h4>
        <p>Email address : {{ $employee->email }}</p>
        <p>Phone : {{ $employee->phone }}</p>
        <p>Role : {{ $employee->role->name }}</p>
        <p>Department : {{ $employee->department->name }}</p>
        <p>Address : {{ $employee->address }}</p>
        <p>Join Date : {{ \Carbon\Carbon::parse ($employee->created_at)->toDateString(); }}</p>
      </div>
      <a href="{{ route('employee#showLists') }}" class="btn-back">Back</a>
    </div>
    </form>
  </div>
</div>
</div>
@endsection