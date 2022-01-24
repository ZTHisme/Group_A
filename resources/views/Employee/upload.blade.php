@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/employeeupload.css') }}">
@endsection
@section('content')
<div class="con mt-5 text-center">
  <h1 class="mb-4 emp">Upload Employee Lists</h1>
  @if(isset($errors)&& $errors->any())
  <div class="alert-danger">
    @foreach ($errors->all() as $error)
    {{$error}}
    @endforeach
  </div>
  @endif
  <form action="{{ route('employees.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4" >
      <div class="custom-file">
        <input type="file" name="file" accept=".csv, .xlsx">
      </div>
    </div>
    <button class="btn-import">Import data</button>
  </form>
</div>
@endsection