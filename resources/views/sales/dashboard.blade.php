@extends('layouts.app')
@section('content')
<div class="form-group" id="reportrange">
  <input type="text" name="daterange">
</div>
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
<script type="text/javascript">
  var customers = {!! json_encode($customers) !!};
  var orders = {!! json_encode($orders) !!};
  var revenue = {!! json_encode($revenue) !!};
</script>
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection