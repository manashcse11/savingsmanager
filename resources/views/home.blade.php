@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'Hours per Day'],
                                    ['Work',     11],
                                    ['Eat',      2],
                                    ['Commute',  2],
                                    ['Watch TV', 2],
                                    ['Sleep',    7]
                                ]);

                                var options = {
                                    title: 'My Daily Activities'
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                chart.draw(data, options);
                            }
                        </script>
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
