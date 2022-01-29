@extends('layouts.app')

@section('title', 'Upload CSV')

@section('css')
<link rel="stylesheet" href="{{ asset('css/setting/mstcalendarupload.css') }}">
@endsection

@section('content')
<div class="con mt-5 text-center">
  <h1 class="mb-4 emp">Upload Working Days For One Year</h1>
  <form action="{{ route('calendar.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
      <div class="custom-file">
        <input type="file" name="file" accept=".csv, .xlsx">
      </div>
    </div>
    <button class="btn-import">Import data</button>
  </form>
</div>
{!! JsValidator::formRequest('App\Http\Requests\ImportMstCalendarsRequest'); !!}
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection