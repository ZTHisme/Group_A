@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('project management/project_show.css') }}">
@endsection
@section('content')
<div class="delete-btn">
 <button class="my-button1">Delete</button>
 </div>
<div class="card-show">
  
  <div class="box-show">
    
    <p>Manager Name- Manager</p>
    <p>Project Name- Project 1</p>
    <p>Members - 5</p>
    <p>Pending tasks</p> 
  </div>
  </div>

  <div id="container">
  <h2>Member Lists</h2>
  <p class="detail">Member 1</p>
   <p class="detail">Member 2</p>
    <p class="detail">Member 3</p>
     <p class="detail">Member 4</p>
      <p class="detail">Member 5</p>

  </div>




<div class="position">
  <table class="table table-striped task-table">
        <thead>
          <th>No</th>
          <th>Task Name</th>
          <th>Status</th>
          <th>Assigner</th>
          <th>Assignee</th>
          <th>Action</th>
          
           </thead>
        <tbody>
         <tr>
            <td>1</td>
            <td>Task1 </td>
            <td>Pending </td>
            <td>Manager </td>
            <td>member 1/2/3/4/5</td>
            <td><button class="button-4">Mark as finish</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Task2 </td>
            <td>Pending </td>
            <td>Manager </td>
            <td>member 1/2/3/4/5</td>
            <td><button class="button-4">Mark as finish</button></td>
          </tr>
  </table>
</div>
      @endsection
