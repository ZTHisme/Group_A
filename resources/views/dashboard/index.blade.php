@extends('layouts.app')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/graph.css') }}">
@endsection

@section('content')

<body>
  <div class="container clearfix">
    <p class="show-date">Date:
      <?php echo (strftime("%d/%m/%Y %H:%M")); ?></p>
  </div>
  <div class="container clearfix">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user-check icon-margin"></i>
        Present Employee
      </div>
      <div class="card-body"><canvas id="pie-chart"></canvas></div>
    </div>

    <div class="card">
      <div class="card-header">
        <i class="fas fa-user-times icon-margin"></i>
        Absent Employee
      </div>
      <div class="card-body"><canvas id="bar-chart"></canvas></div>
    </div>
  </div>
  @endsection
  @section('script')
  <script src="{{ asset('js/graph/library/chart-js.js') }}"></script>
  <script src="{{ asset('js/graph/library/jquery.js') }}"></script>
  <script src="{{ asset('js/graph/graph.js') }}"></script>
  <script>
    chartdata = '<?php echo $chart_data; ?>';
  </script>
  <script>
    barchartdata = '<?php echo $barchart_data; ?>';
  </script>
  @endsection
  