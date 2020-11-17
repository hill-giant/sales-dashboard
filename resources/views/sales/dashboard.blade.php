@extends('layouts.app')
@section('content')
<div class="container">
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  var customer = <?php echo json_encode($customer); ?>;
  var order = <?php echo json_encode($order); ?>;
  var revenue = <?php echo json_encode($revenue); ?>;
  var myDateFormat = '%Y %m %d';
  $(function() {
    $('#container').highcharts({
      title: {
        text: 'Sales Dashboard'
      },
      xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: {
              millisecond: myDateFormat,
              second: myDateFormat,
              minute: myDateFormat,
              hour: myDateFormat,
              day: myDateFormat,
              week: myDateFormat,
              month: myDateFormat,
              year: myDateFormat
          }
      },
      yAxis: {
        title: {
          text: 'Total'
        },
        plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
      },
      legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
      },
      series: [{
        name: 'Customer',
        data: customer
      },
      {
        name:'Orders',
        data: order
      },
      {
        name: 'Revenue',
        data: revenue
      }]
    });
  });
</script>
@endsection