function renderChart(customers, orders, revenue) {
    'use strict';
    var ctx = $('#myChart');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: customers.label,
            datasets: [{
                data: customers.data,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            },
            {
                data: orders.data,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#000000',
                borderWidth: 4,
                pointBackgroundColor: '#000000'
            },
            {
                data: revenue.data,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#111111',
                borderWidth: 4,
                pointBackgroundColor: '#111111'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    return myChart;
}

$(function () {
    var moment = require('moment');
    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        "startDate": moment().subtract(30, 'days'),
        "endDate": moment(),
    }, function (start, end, label) {
            var _token = $('meta[name=csrf-token]').attr('content');
            var _start = start.format("yyyy MM DD");
            var _end = end.format("yyyy MM DD");
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: { _token: _token, start: _start, end: _end },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        console.log(data.success);
                        myChart.destroy();
                        renderChart(data[0].customers, data[1].orders, data[2].revenue)
                    } else {
                        $.each(data.error, function (key, value) {
                                $('.' + key + '_err').text(value);
                            });
                    }
                }
            });
        });
});

// TODO(nclowes): Look into alternatives to a global var.
var myChart = renderChart(customers, orders, revenue);