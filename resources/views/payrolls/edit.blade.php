@extends('layouts.app')

@section('title', 'Payroll Edit')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payroll/edit.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card">
    <div class="listcard-header mr-table">
      Edit Payroll
    </div>
    <form action="{{ route('payrolls#updatePayroll', [$employee->id]) }}" method="POST">
      {{ csrf_field() }}
      @method('PATCH')
      <div class="row clearfix">
        <div class="float-left text">
          <label for="basic_salary">Basic Salary</label>
        </div>
        <div class="float-left input">
          <input type="number" name="basic_salary" class="form-control" value="{{ $employee->salary->basic_salary }}">
        </div>
      </div>
      <div class="row clearfix">
        <div class="float-left text">
          <label for="overtime_fee">Overtime Fee</label>
        </div>
        <div class="float-left input">
          <input type="number" name="overtime_fee" class="form-control" value="{{ $employee->salary->overtime_fee }}">
        </div>
      </div>
      <div class="row clearfix">
        <div class="float-left text">
          <label for="leave_fine">Leave Fine</label>
        </div>
        <div class="float-left input">
          <input type="number" name="leave_fine" class="form-control" value="{{ $employee->salary->leave_fine }}">
        </div>
      </div>
      <div class="btn-group">
        <input type="submit" value="Update" class="blue-btn">
        <a href="#" id="back" class="red-btn">Cancel</a>
      </div>
    </form>
  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\UpdatePayrollRequest'); !!}
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection