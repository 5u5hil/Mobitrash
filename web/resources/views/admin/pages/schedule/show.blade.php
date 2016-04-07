@extends('admin.layouts.default')
@section('content')
<style>
    .view-table tr td:first-child{
        font-weight: bold;
    }
</style>
<section class="content-header">
    <h1>
        Schedule
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.schedule.view') }}"><i class="fa fa-coffee"></i>Schedule</a></li>
        <li class="active">view</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><b>{{$schedule->name}}</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered view-table">
                        <tbody>
                            <tr>
                                <td>For</td>
                                <td>
                                    {{$schedule->for}}
                                </td>
                            </tr>
                            <tr>
                                <td>Van</td>
                                <td>                                                                     
                                    @foreach($vans as $key => $van)
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            {{$van['name'].' - '.$van['asset_no']}}                                                                              
                                        </div> 
                                    </div>
                                    @endforeach                                   
                                </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td>
                                    @foreach($operators as $key => $operator)
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            {{$operator['first_name'].' '.$operator['last_name']}}                                                                              
                                        </div> 
                                    </div>
                                    @endforeach 
                                </td>
                            </tr>
                            <tr>
                                <td>Driver</td>
                                <td>
                                    @foreach($drivers as $key => $driver)
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            {{$driver['first_name'].' '.$driver['last_name']}}                                                                              
                                        </div> 
                                    </div>
                                    @endforeach 
                                </td>
                            </tr>
                            <tr>
                                <td>Pickups</td>
                                <td style="padding: 20px;">
                                    @if($pickups->count()>0)
                                    <div class="row form-group">
                                        <div style="font-weight: bold; border-bottom: 1px solid #ECECEC;">
                                        <div class="col-sm-2">
                                            Name
                                        </div>
                                        <div class="col-sm-3">
                                            Address
                                        </div>
                                        Approx. Processing Time
                                        <div class="col-sm-2">
                                            Pickup Time                                            
                                        </div> 
                                        </div>
                                    </div>
                                    @foreach($pickups as $key => $pickup)

                                    <div class="row form-group">
                                        <div class="col-sm-2">
                                            {{$pickup->user->first_name}}
                                        </div>
                                        <div class="col-sm-3">
                                            {{$pickup->address->address}}
                                        </div>
                                        <div class="col-sm-2">
                                            {{$pickup->approximate_processing_time}}
                                        </div>
                                        <div class="col-sm-2">
                                            {{$pickup->pickuptime}}                                            
                                        </div> 
                                    </div>
                                    @endforeach
                                    @endif
                                </td>
                            </tr>

                        </tbody></table>
                </div>

            </div>
        </div>
    </div>
</section>


@stop 

@section('myscripts')

<script>

    $(".addMore").click(function () {
        $(".existing").append($(".addNew").html());
        $('[name*="user_id"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][user_id]");
        });
        $('[name*="user_address_id"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][user_address_id]");
        });
        $('[name*="approximate_processing_time"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][approximate_processing_time]");
        });
        $('[name*="pickuptime"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][pickuptime]");
        });

    });

    $("body").on("change", ".select_user", function () {
        var select = $(this);
        var options = $([]);
        select.parent().parent().find(".approx_time").val('');
        options = options.add($("<option />", {text: 'Select Address', value: ''}));
        $.ajax({
            url: "<?= route('getUserAdd') ?>",
            type: "GET",
            data: {
                uid: select.val()
            },
            success: function (data) {
                $.each(data, function (k, v) {
                    var opt = $("<option />", {text: v.address, value: v.id});
                    options = options.add(opt);
                });
                select.parent().parent().find(".select_add").html(options);
            }
        });
    });

    $("body").on("change", ".select_add", function () {
        var select = $(this);
        var userid = select.parent().parent().find(".select_user").val();
        console.log(userid);
        $.ajax({
            url: "<?= route('getUserApproxTime') ?>",
            type: "GET",
            data: {
                uid: userid,
                address_id: select.val()
            },
            success: function (data) {
                select.parent().parent().find(".approx_time").val(data.approximate_processing_time);
            }
        });
    });

</script>

@stop