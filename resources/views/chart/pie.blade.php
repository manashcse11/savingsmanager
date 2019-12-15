{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $type_percentage_pie; ?>);

        var options = {
            title: 'Type Percentage'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<div id="piechart" style="width: 100%; height: 450px;"></div>
