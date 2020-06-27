$(function () {
    let resultChart = $('#container').data('chart');
    let chartData = [];

    resultChart.forEach(function(element){
        let ele = {
            name : element.name,
            y : parseFloat(element.y),
        };
        if (ele.y > 0) {
            chartData.push(ele);
        }
    });

    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Result Statistics'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: chartData
        }]
    });
});
