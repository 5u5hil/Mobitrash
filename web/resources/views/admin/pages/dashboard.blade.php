@extends('admin.layouts.default')

<style>
    button.accordion {
        background-color: #fff;
        color: #444;
        cursor: pointer;
        padding: 10px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
        border-top: 1px solid #efefef;
        font-weight: bold;
    }

    .van-tracking{
        min-height: 300px;
    }


    button.accordion:after {
        content: '\02795';
        font-size: 13px;
        color: #777;
        float: right;
        margin-left: 5px;
    }

    button.accordion.active:after {
        content: "\2796";
    }

    div.acc-con {
        background-color: #f3f3f3;
        display: none;
        overflow: hidden;
        transition: 0.6s ease-in-out;
        opacity: 0;
    }
    div.acc-con div{
        padding: 8px;
        padding-left: 20px;
    }

    div.acc-con.show {
        opacity: 1;
        display: block;
    }
</style>

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active" style="height: 70px;">
                    <h3 class="widget-user-username">Subscriptions</h3>
                </div>
                <div class="box-footer" style="padding-top: 0px;font-size: 12px;">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$subscription['current_week']}}</h5>
                                <span class="description-text">Current Week</span>
                            </div>
                        </div>
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$subscription['last_week'] }}</h5>
                                <span class="description-text">Last Week</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$subscription['current_month']}}</h5>
                                <span class="description-text">Current Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-red" style="height: 70px;">
                    <h3 class="widget-user-username">Pending Payments</h3>
                </div>
                <div class="box-footer" style="padding-top: 0px;font-size: 12px;">
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$pending_payment['current_month']}}</h5>
                                <span class="description-text">Current Month</span>
                            </div>
                        </div>
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$pending_payment['last_month'] }}</h5>
                                <span class="description-text">Last Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green" style="height: 70px;">
                    <h3 class="widget-user-username">Total Monthly Revenue</h3>
                </div>
                <div class="box-footer" style="padding-top: 0px;font-size: 12px;">
                    <div class="row">
                        <div class=" border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ @$monthly_sub_amt }}</h5>
                                <span class="description-text">Current Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div><!-- /.row -->

    <div class="row">        
<!--        <div class="col-md-12">
            <div class="box box-warning" style="background: transparent; border-left: 1px solid #fff;border-bottom: 1px solid #fff;border-right: 1px solid #fff;">
                <div class="box-header with-border"  style="background: #fff;"> 
                    <h3 class="box-title">Van Tracking</h3>
                </div> /.box-header 
                <div class="box-body">
                    <div class="row">-->
                        @foreach($vans as $van)
                        @if(!$van['schedules'])
                        @continue
                        @endif
                        <div class="col-md-4">
                            <div class="box box-widget widget-user-2">
                                <div class="widget-user-header bg-yellow">                    
                                    <h3 class="widget-user-username">{{$van['name']}}</h3>
                                    <h5 class="widget-user-desc">{{$van['asset_no']}}</h5>
                                </div>
                                <div class="box-footer no-padding van-tracking">
                                    @foreach($van['schedules'] as $schedule)
                                    <button class="accordion">{{ @$schedule['name']}}</button>
                                    <div class="acc-con">
                                        @foreach($schedule['pickups'] as $pickup)
                                        <div>{{$pickup['subscription']['name'] }}<span class="pull-right"><?php echo $pickup['isPicked'] ? '<i class="fa fa-check text-success"></i>' : '' ?></span></div>
                                        @endforeach
                                    </div>
                                    @endforeach

                                </div>
                                <div class="box-footer clearfix">
                                    <a href="{{route('admin.location.map',['id' => $van['id']])}}" target="_BLANK" class="btn btn-sm btn-success btn-flat pull-right">View on Map</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
<!--                    </div>
                </div>
            </div>
        </div>-->
    </div><!-- /.row -->

    <div class="row">   
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$waste_till_date_sum}} kg waste MobiTrashed!</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="chart-responsive">
                                <canvas id="pieChartAll" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <ul class="chart-legend clearfix">
                                <?php foreach ($allwastes as $waste) {
                                    ?>
                                    <li><i class="fa fa-circle" style="color:{{$waste['color']}}"></i> {{$waste['name']}}</li>
                                <?php } ?>

                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Waste Treated (kg)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <ul class="chart-legend clearfix">
                                <?php foreach ($wastes as $waste) {
                                    ?>
                                    <li><i class="fa fa-circle" style="color:{{$waste['color']}}"></i> {{$waste['name']}}</li>
                                <?php } ?>

                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Additives Treated (kg)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="chart-responsive">
                                <canvas id="pieChartAdditive" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <ul class="chart-legend clearfix">
                                <?php foreach ($additives as $additive) {
                                    ?>
                                    <li><i class="fa fa-circle" style="color:{{$additive['color']}}"></i> {{$additive['name']}}</li>
                                    <?php } ?>

                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

@stop
@section('myscripts')

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
    this.classList.toggle("active");
    this.nextElementSibling.classList.toggle("show");
    }
    }


    var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
    };
    //////////////////////  All mobitrashed
    var pieChartCanvasAll = $("#pieChartAll").get(0).getContext("2d");
    var pieChartAll = new Chart(pieChartCanvasAll);
    var PieDataAll = [
<?php foreach ($allwastes as $waste) {
    ?>
        {
        value: <?php echo $waste['total_quantity'] ?>,
                color: "<?php echo $waste['color'] ?>",
                highlight: "<?php echo $waste['color'] ?>",
                label: "<?php echo $waste['name'] ?>"
        },
<?php } ?>
    ];
    pieChartAll.Doughnut(PieDataAll, pieOptions);
    ////////////////////// Daily waste
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
<?php foreach ($wastes as $waste) {
    ?>
        {
        value: <?php echo $waste['total_quantity'] ?>,
                color: "<?php echo $waste['color'] ?>",
                highlight: "<?php echo $waste['color'] ?>",
                label: "<?php echo $waste['name'] ?>"
        },
<?php } ?>
    ];
    pieChart.Doughnut(PieData, pieOptions);
    ////////////////Aditive
    var pieAChartCanvas = $("#pieChartAdditive").get(0).getContext("2d");
    var pieAChart = new Chart(pieAChartCanvas);
    var PieAData = [
<?php foreach ($additives as $additive) {
    ?>
        {
        value: <?php echo $additive['total_quantity'] ?>,
                color: "<?php echo $additive['color'] ?>",
                highlight: "<?php echo $additive['color'] ?>",
                label: "<?php echo $additive['name'] ?>"
        },
<?php } ?>
    ];
    pieAChart.Doughnut(PieAData, pieOptions);

</script>

@stop