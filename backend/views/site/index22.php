<?php
/* @var $this yii\web\View */
use dosamigos\chartjs\ChartJs;
// use dosamigos\chartjs\ChartJs;

$this->title = 'Color box';
?>





    <head>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Top 10 Customers of the Month"
      },
      data: [
      {
        type: "bar",
        dataPoints: [
        { y: 185, label: "AA Enterprises"},
        { y: 128, label: "Solstech"},
        { y: 246, label: "ThreadLtd"},
        { y: 272, label: "AAAAA"},
        { y: 200, label: "bb"},
        ]
      },
      //       {
      //   type: "bar",
      //   dataPoints: [
      //   { y: 0, label: "Italy"},
      //   { y: 0, label: "China"},
      //   { y: 0, label: "France"},
      //   { y: 0, label: "Great Britain"},
      //   ]
      // },

      ]
    });

chart.render();
}
</script>



<!--
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Top 10 Customers of the Month"
      },
      data: [
      {
        type: "bar",
        dataPoints: [
        { y: 185, label: "AA Enterprises"},
        { y: 128, label: "Solstech"},
        { y: 246, label: "ThreadLtd"},
        { y: 272, label: "AAAAA"},
        ]
      },
            {
        type: "bar",
        dataPoints: [
        { y: 0, label: "Italy"},
        { y: 0, label: "China"},
        { y: 0, label: "France"},
        { y: 0, label: "Great Britain"},
        ]
      },

      ]
    });

chart.render();
}
</script>-->
<script type="text/javascript" src="../views/site/script/canvasjs.min.js"></script>

        <meta charset="UTF-8">
        <title>AdminLTE | Flot Charts</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="adminlte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="adminlte/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>


<div class="site-index">
<div id="chartContainer" style="height: 300px; width: 100%;">
  </div>



                    <div class="row">
                        <div class="col-md-6">

                            <!-- Line chart -->
                            <div class="box box-primary">

                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Bar Chart</h3>
                                </div>

                          <div class="box-body">
<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 50,
        'width' => 50
    ],
    'data' => [
        'labels' => ["January", "February", "March", "April", "May","June","July","August","September","October","November","December"],
        'datasets' => [
            [
                'label' => "My First dataset",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' => "My Second dataset",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => [28, 48, 40, 19, 96, 27, 100]
            ]
        ]
    ]
]);
?>                            
</div>
</div><!-- /.box -->


                            <!-- Area chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Full Width Area Chart</h3>
                                </div>
                                <div class="box-body">
                                    <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->

                        <div class="col-md-6">
                            <!-- Bar chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Line Chart</h3>
                                </div>
                                <div class="box-body">
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 50,
        'width' => 50
    ],
    'data' => [
        'labels' => ["January", "February", "March", "April", "May"],
        'datasets' => [
            [
                'label' => "My First dataset",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' => "My Second dataset",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => [28, 48, 40, 19, 96, 27, 100]
            ]
        ]
    ]
]);
?>                            

                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                            <!-- Donut chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Donut Chart</h3>
                                </div>
                                <div class="box-body">
                                    <div id="donut-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->


</div>

  <script src="../../backend/web/adminlte/js/jquery.min.js"></script>



        <!-- Bootstrap -->
        <script src="../../backend/web/adminlte/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../backend/web/adminlte/js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="../../backend/web/adminlte/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../backend/web/adminlte/js/AdminLTE/demo.js" type="text/javascript"></script>
                

        <!-- FLOT CHARTS -->
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="../../backend/web/adminlte/js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
         <!-- FLOT PIE PLUGIN - also used to draw donut charts  -->
        <script src="../../backend/web/adminlte/js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="../../backend/web/adminlte/js/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

        <script type="text/javascript">

    window.onload=function(){

            // $(function() {

                /*
                 * Flot Interactive Chart
                 * -----------------------
                 */
                // We use an inline data source in the example, usually data would
                // be fetched from a server
                var data = [], totalPoints = 100;
                function getRandomData() {

                    if (data.length > 0)
                        data = data.slice(1);

                    // Do a random walk
                    while (data.length < totalPoints) {

                        var prev = data.length > 0 ? data[data.length - 1] : 50,
                                y = prev + Math.random() * 10 - 5;

                        if (y < 0) {
                            y = 0;
                        } else if (y > 100) {
                            y = 100;
                        }

                        data.push(y);
                    }

                    // Zip the generated y values with the x values
                    var res = [];
                    for (var i = 0; i < data.length; ++i) {
                        res.push([i, data[i]]);
                    }

                    return res;
                }

                var interactive_plot = $.plot("#interactive", [getRandomData()], {
                    grid: {
                        borderColor: "#f3f3f3",
                        borderWidth: 1,
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        shadowSize: 0, // Drawing is faster without shadows
                        color: "#3c8dbc"
                    },
                    lines: {
                        fill: true, //Converts the line chart to area chart
                        color: "#3c8dbc"
                    },
                    yaxis: {
                        min: 0,
                        max: 100,
                        show: true
                    },
                    xaxis: {
                        show: true
                    }
                });

                var updateInterval = 500; //Fetch data ever x milliseconds
                var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
                function update() {

                    interactive_plot.setData([getRandomData()]);

                    // Since the axes don't change, we don't need to call plot.setupGrid()
                    interactive_plot.draw();
                    if (realtime === "on")
                        setTimeout(update, updateInterval);
                }

                //INITIALIZE REALTIME DATA FETCHING
                if (realtime === "on") {
                    update();
                }
                //REALTIME TOGGLE
                $("#realtime .btn").click(function() {
                    if ($(this).data("toggle") === "on") {
                        realtime = "on";
                    }
                    else {
                        realtime = "off";
                    }
                    update();
                });
                /*
                 * END INTERACTIVE CHART
                 */


                /*
                 * LINE CHART
                 * ----------
                 */
                //LINE randomly generated data

                var sin = [], cos = [];
                for (var i = 0; i < 14; i += 0.5) {
                    sin.push([i, Math.sin(i)]);
                    cos.push([i, Math.cos(i)]);
                }
                var line_data1 = {
                    data: sin,
                    color: "#3c8dbc"
                };
                var line_data2 = {
                    data: cos,
                    color: "#00c0ef"
                };
                $.plot("#line-chart", [line_data1, line_data2], {
                    grid: {
                        hoverable: true,
                        borderColor: "#f3f3f3",
                        borderWidth: 1,
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        shadowSize: 0,
                        lines: {
                            show: true
                        },
                        points: {
                            show: true
                        }
                    },
                    lines: {
                        fill: false,
                        color: ["#3c8dbc", "#f56954"]
                    },
                    yaxis: {
                        show: true,
                    },
                    xaxis: {
                        show: true
                    }
                });
                //Initialize tooltip on hover
                $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
                    position: "absolute",
                    display: "none",
                    opacity: 0.8
                }).appendTo("body");
                $("#line-chart").bind("plothover", function(event, pos, item) {

                    if (item) {
                        var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                        $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                                .css({top: item.pageY + 5, left: item.pageX + 5})
                                .fadeIn(200);
                    } else {
                        $("#line-chart-tooltip").hide();
                    }

                });
                /* END LINE CHART */

                /*
                 * FULL WIDTH STATIC AREA CHART
                 * -----------------
                 */
                var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
                    [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
                    [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]];
                $.plot("#area-chart", [areaData], {
                    grid: {
                        borderWidth: 0
                    },
                    series: {
                        shadowSize: 0, // Drawing is faster without shadows
                        color: "#00c0ef"
                    },
                    lines: {
                        fill: true //Converts the line chart to area chart
                    },
                    yaxis: {
                        show: false
                    },
                    xaxis: {
                        show: false
                    }
                });

                /* END AREA CHART */

                /*
                 * BAR CHART
                 * ---------
                 */

                var bar_data = {
                    data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
                    color: "#3c8dbc"
                };
                $.plot("#bar-chart", [bar_data], {
                    grid: {
                        borderWidth: 1,
                        borderColor: "#f3f3f3",
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.5,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });
                /* END BAR CHART */

                /*
                 * DONUT CHART
                 * -----------
                 */

                var donutData = [
                    {label: "Series2", data: 30, color: "#3c8dbc"},
                    {label: "Series3", data: 20, color: "#0073b7"},
                    {label: "Series4", data: 50, color: "#00c0ef"}
                ];
                $.plot("#donut-chart", donutData, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            innerRadius: 0.5,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: labelFormatter,
                                threshold: 0.1
                            }

                        }
                    },
                    legend: {
                        show: false
                    }
                });
                /*
                 * END DONUT CHART
                 */

            };

            /*
             * Custom Label formatter
             * ----------------------
             */
            function labelFormatter(label, series) {
                return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                        + label
                        + "<br/>"
                        + Math.round(series.percent) + "%</div>";
            }
        </script>
