<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $yearly_individual_bar; ?>);

        var options = {
            title: 'Yearly Savings of Individuals',
            chartArea: {width: '50%'},
            hAxis: {
                title: 'Total Savings',
                minValue: 0,
                textStyle: {
                    bold: true,
                    fontSize: 12,
                    color: '#4d4d4d'
                },
                titleTextStyle: {
                    bold: true,
                    fontSize: 18,
                    color: '#4d4d4d'
                }
            },
            vAxis: {
                title: 'Year',
                textStyle: {
                    fontSize: 14,
                    bold: true,
                    color: '#848484'
                },
                titleTextStyle: {
                    fontSize: 14,
                    bold: true,
                    color: '#848484'
                }
            }
        };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div" style="width: 100%; height: 450px;"></div>
