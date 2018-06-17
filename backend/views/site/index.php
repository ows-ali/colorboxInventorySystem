<?php
use dosamigos\chartjs\ChartJs;
use miloschuman\highcharts\Highcharts;
// use backend\modules\planday\models\planday;
use kartik\date\DatePicker;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
// use common\models\General;
use common\models\Order;

$total_orders= sizeof(Order::find()->where(['>=', 'created_at',date('Y-m-01 00:00:00')])->all());
// print_r(Order::find()->where(['>=', 'created_at',date('Y-m-01 00:00:00')])->all());
$pending_orders = sizeof(Order::find()->where(['status'=>'Pending'])->all());
$approved_orders = sizeof(Order::find()->where(['status'=>'Approved'])->andWhere(['>=', 'created_at',date('Y-m-01 00:00:00')])->all());
// print_r(Order::find()->where(['status'=>'Approved'])->andWhere(['>=', 'created_at',date('Y-m-01 00:00:00')])->all());
$this->title="Dashboard";
?>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?php echo $total_orders; ?>
                </h3>
                <p>
                    Total Orders-Current Month
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?php echo $approved_orders; ?>
                </h3>
                <p >
                    Approved Orders-Current Month
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?php echo $pending_orders; ?>
                </h3>
                <p>
                    Pending Orders-Total
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div><!-- ./col -->
    
</div><!-- /.row -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
          <?= DatePicker::widget([//$form->field($formModel, 'from_date')->widget(DatePicker::classname(), [
                    'name'=>'year_field',
                    'options' => ['placeholder' => Yii::t('app', 'Starting Date')],
                    'attribute2'=>'to_date',
                    'value'=>'2018',
                    // 'type' => DatePicker::TYPE_RANGE,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'startView'=>'year',
                        'minViewMode'=>'years',
                        'format' => 'yyyy'
                    ],
                    'options'=>['value'=>'2018','class'=>'year_field','id'=>'year_field']
                ]) ?>
        </div>
</div>

        <div class='row' >
            <div class='col-md-12' style='margin-bottom:15px;'>
                <div id="top_plans" ></div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12' style='margin-bottom:15px;'>
                <div id="top_executed"></div>
            </div>
        <div>
        <div class='row' >
            <div class='col-md-6' style='margin-bottom:15px;'>
                <div id="top_doctor_sample"     ></div>
            </div>
        </div>

      
<script src="js/highcharts.js"></script>

<script type="text/javascript">
    var cat_orders = ['Africa', 'America', 'Asia', 'Europe', 'Oceania'];
    var cat_sub_orders = ['Africa', 'America', 'Asia', 'Europe', 'Oceania'];
    var cat_doc_samp = ['Africa', 'America', 'Asia', 'Europe', 'Oceania'];
    
    var dat_orders = [107, 231, 335, 403, 525];
    var dat_sub_orders =[107, 231, 335, 403, 525];
    var dat_doc_samp =[107, 231, 335,  525];

    var maintitle = 'Overall';
    var base_url = window.location.pathname;
    var base_url = base_url.split( 'web/' );
    base_url=base_url[0];
    base_url=base_url+'web/';
        
    var date_start = "";//document.getElementById('w0').value//$('.date_field').val();;
    var date_end  = "";//document.getElementById('w0-2').value;
    var region_val = "";
    var city_val = "";
    var lim = 5;
    var year_val = '2018';
    window.onload=function(){

        $( document ).ready(function() {
            console.log( "ready!" );
            setdata();
            // make_sub_graphs();
            // makegraphs();
        });//docready   
        $('.year_field').on('change',function(){

            setdata();   
            document.getElementById('top_executed').innerHTML="";
            // console.log(date_start);
            // console.log(date_end);
            // console.log(region_val);
            // console.log(city_val);
        });
    };//onload

    function setdata()
    {
            // date_start = $('.date_field').val();
            // date_end = $('#w0-2').val();
            // region_val = $('.region_field').val();
            // city_val = $('.city_field').val();
            year_val = $('.year_field').val();

            $.ajax({
                   url: base_url+'site/forgraphs',
                   // '<?php echo Yii::$app->request->baseUrl. '/general/ajaxactiongetareas' ?>',
                   type: 'post',
                   data: {
                        // lim : lim,
                        // date_start : date_start,
                        // date_end  : date_end,
                        // region_val : region_val,
                        year_val  : year_val
                             //searchname: $("#citydata").val() , 
                             // _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
                         },
                   success: function (data) {
                    console.log(data);
                    // console.log(data[0]);
                    // console.log(data[0][0]);
                    // console.log(data[0][0].name_str);

                    // dat_orders=[];
                    // dat_sub_orders=[];                    

                    // dat_doc_samp=[];
                    maintitle="Overall";
                    // if (!(""==region_val))
                    //     maintitle = 'Region wise';
                    // if (!(""==(city_val)))
                    //     maintitle = 'City wise';

console.log(data[0]);
///////////////////
                    dat_orders=[];
                    $.each(data[0], function( index, value ) {
                      //alert( index + ": " + value );
                        dat_orders.push((value));
                    });

                    cat_orders=[];
                    $.each(data[1], function( index, value ) {
                      //alert( index + ": " + value );
                        cat_orders.push((value));
                    });
///////////////////
console.log(cat_orders);
console.log(dat_orders);

                    // dat_sub_orders=[];
                    // $.each(data[1], function( index, value ) {
                    //   //alert( index + ": " + value );
                    //     dat_sub_orders.push(parseFloat(value.val));
                    // });

                    // cat_sub_orders=[];
                    // $.each(data[1], function( index, value ) {
                    //   //alert( index + ": " + value );
                    //     cat_sub_orders.push((value.name_str));
                    // });



                    // dat_doc_samp=[];
                    // $.each(data[2], function( index, value ) {
                    //   //alert( index + ": " + value );
                    //     dat_doc_samp.push(parseFloat(value.val));
                    // });

                    // cat_doc_samp=[];
                    // $.each(data[2], function( index, value ) {
                    //   //alert( index + ": " + value );
                    //     cat_doc_samp.push((value.name_str));
                    // });

                    // console.log(cat_orders);
                    // dat_orders=["99", "30", "7", "17", "94"];
                        // data[0].forEach(dat){
                        //     dat_orders[]=datdat.SPO_PLAN_ID;
                        // };

     // dat_doc_samp =[107, 231, 335,  125, 525];

                   makegraphs();
                   }
            });
    }

    function make_sub_graphs()
    {Highcharts.chart('top_executed', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Orders per Week'
            },
            // subtitle: {
            //     text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
            // },
            xAxis: {
                categories: cat_sub_orders,
                title: {
                    // text: 'Salesman',
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Orders',
                    // align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            // tooltip: {
            //     valueSuffix: ' millions'
            // },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return Highcharts.numberFormat(this.y, 0, ',') + ' ';
                        },
                    }
                }
            },
            // legend: {
            //     layout: 'vertical',
            //     align: 'right',
            //     verticalAlign: 'top',
            //     x: -40,
            //     y: 80,
            //     floating: true,
            //     borderWidth: 1,
            //     backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            //     shadow: true
            // },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Orders',//maintitle,
                        color : '#338856',
                data: dat_sub_orders//[107, 31, 635, 203, 25]
            }, ]
        });

    }

    function makegraphs()
    {


        Highcharts.chart('top_plans', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Orders per month'
            },
            // subtitle: {
            //     text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
            // },
            xAxis: {
                categories: cat_orders,
                title: {
                    text: '',
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Orders',
                    // align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            // tooltip: {
            //     valueSuffix: ' millions'
            // },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return Highcharts.numberFormat(this.y, 0, ',') + ' ';
                        },
                    }
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                // alert('Category: ' + this.category + ', value: ' + this.y);

            $.ajax({
                   url: base_url+'site/for_sub_graphs',
                   // '<?php echo Yii::$app->request->baseUrl. '/general/ajaxactiongetareas' ?>',
                   type: 'post',
                   data: {
                        // lim : lim,
                        // date_start : date_start,
                        // date_end  : date_end,
                        // region_val : region_val,
                        year_val  : year_val,
                        month_val : this.category
                             //searchname: $("#citydata").val() , 
                             // _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
                         },
                   success: function (data) {
                    console.log(data);
                    console.log(data);
                    maintitle="Overall";

console.log(data[0]);
///////////////////
                    dat_sub_orders=[];
                    $.each(data[0], function( index, value ) {

                        dat_sub_orders.push((value));
                    });

                    cat_sub_orders=[];
                    $.each(data[1], function( index, value ) {
                      //alert( index + ": " + value );
                        cat_sub_orders.push((value));
                    });
///////////////////
console.log(cat_sub_orders);
console.log(dat_sub_orders);


                    // cat_doc_samp=[];
                    // $.each(data[2], function( index, value ) {
                    //   //alert( index + ": " + value );
                    //     cat_doc_samp.push((value.name_str));
                    // });

                   make_sub_graphs();
                }
            });
                            }
                        }
                    }
                }

            },

            // legend: {
            //     layout: 'vertical',
            //     align: 'right',
            //     verticalAlign: 'top',
            //     x: -40,
            //     y: 80,
            //     floating: true,
            //     borderWidth: 1,
            //     backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            //     shadow: true
            // },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Orders',//maintitle,
                data: dat_orders//[107, 31, 635, 203, 25]
            }, ]
        });
        //top executed
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
        
    }//make graphs
</script>