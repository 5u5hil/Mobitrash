@extends('admin.layouts.default')



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
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Subscriptions</span>
                    <span class="info-box-number">Current Week</span>
                    <span class="info-box-number">{{ @$subscription['current_week']}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Subscriptions</span>
                    <span class="info-box-number">Last Week</span>
                    <span class="info-box-number">{{ @$subscription['last_week'] }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Subscriptions</span>
                    <span class="info-box-number">Current Month</span>
                    <span class="info-box-number">{{ @$subscription['current_month']}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Payments</span>
                    <span class="info-box-number">Current Month</span>
                    <span class="info-box-number">{{ @$pending_payment['current_month']}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Payments</span>
                    <span class="info-box-number">Last Month</span>
                    <span class="info-box-number">{{ @$pending_payment['last_month'] }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Monthly Revenue</span>
                    <span class="info-box-number">Current Month</span>
                    <span class="info-box-number">{{ @$monthly_sub_amt }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>        
    </div><!-- /.row -->
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-warning" style="background: transparent; border-left: 1px solid #fff;border-bottom: 1px solid #fff;border-right: 1px solid #fff;">
                <div class="box-header with-border"  style="background: #fff;"> 
                    <h3 class="box-title">Van Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
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
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        @foreach($van['schedules']['0']['pickups'] as $pickup)
                                        <li><a>{{$pickup['subscription']['name'] }}<span class="pull-right"><?php echo $pickup['isPicked'] ? '<i class="fa fa-check text-success"></i>' : '' ?></span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->

    <div class="row">        
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Waste Treated</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <?php foreach ($wastes as $waste) {
                                    ?>
                                <li><i class="fa fa-circle-o" style="color:{{$waste['color']}}"></i> {{$waste['name']}}</li>
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
                    <h3 class="box-title">Daily Additives Treated</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartAdditive" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <?php foreach ($additives as $additive) {
                                    ?>
                                <li><i class="fa fa-circle-o" style="color:{{$additive['color']}}"></i> {{$additive['name']}}</li>
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