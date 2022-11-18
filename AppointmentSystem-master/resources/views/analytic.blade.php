<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
        <body>
        @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bar Graph</div>
                        <div class="panel-body">
                            <canvas id="canvas" height="140" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="piechart">
            <h1>Line Graph</h1>
            <canvas id="myChart" height="140" width="700"></canvas>
        </div>
    </div>
        </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>
            var year = <?php echo $year; ?>;
            var user = <?php echo $user; ?>;
            var barChartData = {
                labels: year,
                datasets: [{
                    label: 'User',
                    backgroundColor: "blue",
                    data: user
                }]
            };
        
            window.onload = function() {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
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
                            text: 'Yearly User Joined'
                        }
                    }
                });

                
            };

      var year = <?php echo $year; ?>;
      var user = <?php echo $user; ?>;
  
      const data = {
        labels: year,
        datasets: [{
          label: 'User',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: user,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
        </script>
    </x-app-layout>