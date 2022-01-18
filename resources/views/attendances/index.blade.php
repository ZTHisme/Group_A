@extends('layouts.app')

@section('title', 'Attendance Lists')

@section('content')
<div class="container">
  @checkedout
  <div class="alert alert-success w-50 mx-auto"><i class="fa fa-calendar-check me-3"></i>
    You already have submitted record for today.
  </div>
  @else
  <div class="card w-50 mx-auto">
    <div class="card-header">
      Attendance Submit Form
      <span class="text-muted float-end">{{ now()->format('d-m-Y') }}</span>
    </div>
    <div class="card-body">
      <form action="{{ route('attendances#store') }}" method="POST">
        {{ csrf_field() }}
        @checkedin
        <div class="card-text">Please check out before shutting down your pc.</div>
        @else
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="wfh" value="0">
          <label class="form-check-label" for="wfh">WFH</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="office" value="1">
          <label class="form-check-label" for="office">Office</label>
        </div>
        <div class="form-check form-check-inline float-end">
          <input class="form-check-input" type="checkbox" id="leave" name="leave" value="1">
          <label class="form-check-label" for="leave">Leave</label>
        </div>
        @endcheckedin
        @checkedin
        <a href="{{ route('attendances#update') }}" class="btn btn-primary d-block w-25 mt-3 mx-auto">
          <i class="fa fa-user-check me-2"></i>Check Out
        </a>
        @else
        <button type="submit" class="btn btn-primary d-block mt-3 mx-auto">
          <i class="fa fa-user-check me-2"></i>Check In
        </button>
        @endcheckedin
      </form>
    </div>
  </div>
  @endcheckedout
  <table class="table table-hover" id="attendances">
    <thead>
      <tr>
        <th class="header-cell" scope="col">#</th>
        <th class="header-cell" scope="col">Name</th>
        <th class="header-cell" scope="col">Role</th>
        <th class="header-cell" scope="col">Department</th>
        <th class="header-cell" scope="col">Attendance</th>
        <th class="header-cell" scope="col">Type</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($attendances as $attendance)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $attendance->employee->name }}</td>
          <td>{{ $attendance->employee->role->name }}</td>
          <td>{{ $attendance->employee->department->name }}</td>
          <td>{{ $attendance->status }}</td>
          <td>{{ $attendance->type_name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')
<script src="{{ asset('js/attendances/index.js') }}"></script>
@endsection