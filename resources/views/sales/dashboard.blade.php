@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
          <canvas id="canvas" height="280" width="600"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
  var customer = <?php echo $customer; ?>;
  var order = <?php echo $order; ?>;
  var lineChartData = {
    labels: customer.label,
    datasets: [{
      label: 'Customer',
      backgroundColor: "pink",
      data: customer.data,
      fill: false
    },
    {
      label: 'Orders',
      backgroundColor: "blue",
      data: order.data,
      fill: false
    }
    ]
  };
  window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
      type: 'line',
      data: lineChartData,
      options: {
        scales: {
          x: {
            type: 'time',
            time: {
              unit: 'day',
              displayFormats: {
                'day': 'MM DD'
              }
            }
          }
        },
        elements: {
          rectangle: {
            borderWidth: 2,
            borderColor: '#c1c1c1',
            borderSkipped: 'bottom'
          }
        },
        responsive: true,
        title: {
          display: true,
          text: 'Dashboard'
        }
      }
    });
  };
</script>
@endsection