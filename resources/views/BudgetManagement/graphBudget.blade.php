@extends('layout')
@section('title')
BudgetManagement
@endsection
@section('content')

<div class="row">
    <div class="col-md-11 mx-auto">
        <div class = "card">
        <h4 class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-eye"></i> View Budget Report
            </div>
              <div class="btn-group" role="group" aria-label="button group">
              <!-- Back to Main--> 
              <a class="btn btn-info" title="View Report" href="{{ url('/Budget') }}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
              </div>
        </h4>
        <div class = "card-body">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                      <?php 
                          foreach($data as $item){
                            echo $item;
                        } ?>
                  ]);

                  var options = {
                    title: 'Total Budget For Each Category'
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                  chart.draw(data, options);
                }
              </script>
            </head>
            <body>
              <div id="piechart" style="width: 900px; height: 500px;"></div>
            </body>
          </div>

          <div class = "card-body">
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                      <?php 
                          foreach($data as $item){
                            echo $item;
                        } ?>
                  ]);

                  var options = {
                    title: 'Total Budget For Each Category',
                    pieHole: 0.4,
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                  chart.draw(data, options);
                }
              </script>
            <body>
              <div id="donutchart" style="width: 900px; height: 500px;"></div>
            </body>
            </div>


            <div class = "card-body">
            <head>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Category', 'Category'],
                          <?php 
                          foreach($data as $item){
                            echo $item;
                        } ?>
                  ]);

                  var options = {
                    chart: {
                      title: 'Total Budget For Each Category',
                    }
                  };

                  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                  chart.draw(data, google.charts.Bar.convertOptions(options));
                }
              </script>
            </head>
            <body>
              <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
            </body>
            </div>
            
            <div class = "card-body">
            <head>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Category', 'Category'],
                    <?php 
                          foreach($data as $item){
                            echo $item;
                        } ?>
                  ]);

                  var options = {
                    chart: {
                      title: 'Total Budget For Each Category',
                    },
                    bars: 'horizontal' // Required for Material Bar Charts.
                  };

                  var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                  chart.draw(data, google.charts.Bar.convertOptions(options));
                }
              </script>
            </head>
            <body>
              <div id="barchart_material" style="width: 900px; height: 500px;"></div>
            </body>
              </div>

        </div>       
    </div>
</div>
@endsection