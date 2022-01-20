@extends('layouts.app')

@section('title', 'Employees List')

@section('css')
<link rel="stylesheet" href="{{ asset('css/employeelist.css') }}">
@endsection
@section('content')
<div class="container">
  <div class="list-card">
    <div class="listcard-header">
      Employee Lists
    </div>
    <div class="clearfix">
      <form action="{{ route('employee#showLists') }}" method="GET" class="searchForm">
        <div class="input-group my-5">
          <input type="text" class="rounded-input" placeholder="Name" name="name">
          <input type="date" placeholder="Start Date" name="start_date">
          <input type="date" placeholder="End Date" name="end_date">
          <button class="search-btn" type="submit">Search</button>
        </div>
      </form>
      <a href="#" class="pull-right"><i class="fas fa-user-plus mr-icon"></i></a>
    </div>
    <div class="card-body">
      <table class="table table-striped task-table">
        <thead>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th>Department</th>
          <th>Join date</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($employees as $employee)
          <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->role }}</td>
            <td>{{ $employee->department }}</td>
            <td>{{ \Carbon\Carbon::parse ($employee->created_at)->toDateString();}}</td>
            <td>
              <a href="" class="blue-btn">Show</a>
              @can('isManager')
              <a href="" class="yellow-btn">Edit</a>
              <form action="" class="form-display" onclick="return confirm('Are you sure?')" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="red-btn">
                  Delete
                </button>
              </form>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection