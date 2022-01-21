@extends('layouts.app')

@section('title', 'Attendance Lists')
@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection
@section('content')
<div class="container">
  @checkedout
  <div class="success-msg w-50 mx-auto"><i class="fa fa-calendar-check mr-icon"></i>
    You already have submitted record for today.
  </div>
  @else
  <div class="card-submit w-50 mx-auto">
    <div class="cardheader-submit clearfix">
      Attendance Submit Form
      <span class="txt-date">{{ now()->format('d-m-Y') }}</span>
    </div>
    <div class="card-body clearfix">
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
        <a href="{{ route('attendances#update') }}" class="blue-btn checkout-btn">
          <i class="fa fa-user-check mr-icon"></i>Check Out
        </a>
        @else
        <button type="submit" class="blue-btn checkin-btn">
          <i class="fa fa-user-check mr-icon"></i>Check In
        </button>
        @endcheckedin
      </form>
    </div>
  </div>
  @endcheckedout
  <div class="list-card">
    <div class="listcard-header mr-table">
      Attendance Lists
    </div>
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
</div>
@endsection

@section('script')
<script src="{{ asset('js/attendances/index.js') }}"></script>
@endsection