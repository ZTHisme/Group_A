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
            <input type="text" class="form-inline" placeholder="Name" name="name">
            <input type="date" class="form-inline" placeholder="Start Date" name="start_date">
            <input type="date" class="form-inline" placeholder="End Date" name="end_date">
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="panel-body">
      @can('isManager')
      <a href="{{ route('addEmployee.get') }}" class="pull-right"><i class="fas fa-user-plus mr-icon"></i></a>
      @endcan
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
              <a href="{{ route('show.employee.get', [$employee->id]) }}" class="btn btn-primary btn-sm me-2">Show</a>
              @can('update-employee', $employee->id)
              <a href="{{ route('edit.employee.get', [$employee->id]) }}" class="btn btn-warning btn-sm me-2">Edit</a>
              @endcan
              @can('isManager')
              <a href="#" class="delete-btn" data-id="{{ $employee->id }}">Delete</a>
              <form action="{{ route('delete.employee', [$employee->id]) }}" method="POST" id="del-form{{ $employee->id }}">
                @csrf
                @method('DELETE')
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

@section('script')
<script src="{{ asset('js/employee/index.js') }}"></script>
@endsection
