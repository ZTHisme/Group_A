@extends('layouts.app')

@section('title', 'Employees List')

@section('css')
<link rel="stylesheet" href="{{ asset('css/employeelist.css') }}">
@endsection
@section('content')
<div class="container">
  <div class="card text-center">
    <div class="card-header">
      Employee Lists
      <div class="card-body">
        <form action="{{ route('employee#showLists') }}" method="GET">
          <div class="input-group my-5">
            <input type="text" class="form-control" placeholder="Name" name="name">
            <input type="date" class="form-control" placeholder="Start Date" name="start_date">
            <input type="date" class="form-control" placeholder="End Date" name="end_date">
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="panel-body">
      <a href="#" class="pull-right"><i class="fas fa-user-plus mr-icon"></i></a>
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
              <a href="" class="btn btn-primary btn-sm me-2">Show</a>
              @can('isManager')
              <a href="" class="btn btn-warning btn-sm me-2">Edit</a>
              <form action="" class="form-display" onclick="return confirm('Are you sure?')" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm delete">
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
