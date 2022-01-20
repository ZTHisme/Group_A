@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('project management/project_create.css') }}">
@endsection
@section('content')
<div class="box">
  <form action="#">
  <div class="row">
    <div class="col-25">
      <label for="pname">Project Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="pname" name="projectname" placeholder="Enter project">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="github">Github Link</label>
    </div>
    <div class="col-75">
      <input type="text" id="github" name="github" placeholder="Enter Github Link">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="member">Members</label>
    </div>
    <div class="col-75">
     <table class="table table-striped task-table">
        <thead>
          <th>No</th>
          <th>Name</th>
          <th>Action</th>
           </thead>
        <tbody>
         <tr>
            <td>1</td>
            <td>Jack</td>
            <td><button class="button-4">Add</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>David</td>
            <td><button class="button-4">Add</button></td>
          </tr>
      </table>
    <br>
    <input type="submit" value="Submit">
     <input type="submit" value="Cancel">
    </div>
  </div>
  </form>
</div>
@endsection




