@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/employeelist.css') }}">
<!--<link rel="stylesheet" href="{{ asset('css/employee.css') }}">-->
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
      <a href="{{ route('addEmployee.get') }}" class="pull-right"><i class="fas fa-user-plus mr-icon"></i></a>
      <table class="table table-striped task-table">
        <thead>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th>Department</th>
          <th>Join date</th>
          <!--<th>Profile</th>-->
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($employees as $employee)
          <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->role->name }}</td>
            <td>{{ $employee->department->name }}</td>
            <td>{{ \Carbon\Carbon::parse ($employee->created_at)->toDateString();}}</td>
            <!--<td><img src="{{ asset('uploads/employees/' . $employee->profile) }}" /></td>-->
            <td>
              <a href="{{ route('show.employee.get', $employee->id) }}" class="btn btn-primary btn-sm me-2">Show</a>
              <a href="{{ route('edit.employee.get',$employee->id) }}" class="btn btn-sm me-2"><i class="fas fa-edit text-primary"></i></a>
              <i class="fas fa-trash-alt text-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $employee->id }}"></i>
              <!-- Modal -->
              <div class="modal fade" id="modal{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure to delete this record?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <a href="{{ route('delete.employee',$employee->id) }}" class="btn btn-danger">Yes</a>
                    </div>
                  </div>
                </div>
              </div>
              <!--<form action="{{ route('delete.employee',$employee->id) }}" class="form-display" onclick="return confirm('Are you sure?')" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm delete">
                  Delete
                </button>
              </form>-->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection