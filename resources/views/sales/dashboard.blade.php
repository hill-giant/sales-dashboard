@extends('layouts.app')
@section('content')
@section('title', 'Sales Dashboard')
<div class="d-flex pt-3 pb-2 mb border-bottom">
  <h1 class="h2">Sales Dashboard</h1>
</div>
<canvas class="my-4 w-100" id="salesChart" width="900" height="380"></canvas>
</form>
  <div class="form-group" id="reportrange">
    <label for="dashboardRange">Date Range</label>
    <input class="form-control" type="text" name="daterange" id="dashboardRange">
  </div>
</form>
</div>
<script type="text/javascript">
  var customers = {!! json_encode($customers) !!};
  var orders = {!! json_encode($orders) !!};
  var revenue = {!! json_encode($revenue) !!};
</script>
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection