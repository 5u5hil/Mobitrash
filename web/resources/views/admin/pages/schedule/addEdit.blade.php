@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Add New Schedule
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.schedule.view') }}"><i class="fa fa-coffee"></i>Schedule</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($schedule, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('user','Schedule Name',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control', 'placeholder'=>'Schedule Name', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group"> 
                        {!!Form::label('user','For',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('for',null, ["class"=>'form-control datepicker',  'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Van',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('van_id',$vans,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Operators',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('operators[]',$users,$ops, ["class"=>'form-control', "required", "multiple" => true]) !!}
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Drivers',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('drivers[]',$drivers, $opsd, ["class"=>'form-control', "required", "multiple" => true]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <h4>Pickups</h4>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="row clearfix" >
                        <div class="col-sm-2 pull-right">
                            <a class="label label-success active addMore" >Add a Pickup</a> 
                        </div>
                    </div>
                    <br />

                    <div class="existing">
                        @if($pickups->count()>0)

                        @foreach($pickups as $key => $pickup)

                        <div class="row form-group">
                            <div class="col-sm-2">
                                {!! Form::text('user',$pickup->user->first_name, ["class"=>'form-control', "required", "disabled" => "disabled"]) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('address',$pickup->address->address, ["class"=>'form-control', "required", "disabled" => "disabled"]) !!}
                            </div>

                            <div class="col-sm-2">
                                {!! Form::text("pickup[$key][pickuptime]",$pickup->pickuptime, ["class"=>'form-control timepicker-f2', "required"]) !!}
                                {!! Form::hidden("pickup[$key][user_id]",$pickup->user_id) !!}
                                {!! Form::hidden("pickup[$key][user_address_id]",$pickup->user_address_id) !!}

                            </div> 
                            <div class="col-sm-1" style=" text-align: right;">
                                <a data-id="{{ $pickup->id }}" class="label label-danger active delete-pickup DelImg" >Delete</a> 
                            </div>
                            <div class="col-sm-4 sub-info-block">  
                                <div class="sub-info">
                                    <div class="info-left">Frequency</div><div>{{ @$pickup->sub_deatils->frequency->name}}</div>
                                </div>
                                <div class="sub-info">
                                    <div class="info-left">Preferred Time Slot</div><div>{{ @$pickup->sub_deatils->timeslot->name}}</div>
                                </div>                                
                                <div class="sub-info">
                                    <div class="info-left">Approx Processing Time</div><div>{{ @$pickup->sub_deatils->approximate_processing_time}}</div>            
                                </div>
                            </div> 


                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            {!! Form::hidden('id',null) !!}
                            {!! Form::hidden('added_by',Auth::id()) !!}
                            {!! Form::submit('Submit',["class" => "btn btn-primary"]) !!}
                        </div>
                    </div>
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</section>

<div class="addNew" style="display: none;">
    <div class="row form-group">
        <div class="col-sm-2">
            {!! Form::select("pickup[0][user_id]",$customers,null, ["class"=>'form-control select_user', "required"]) !!}
        </div>
        <div class="col-sm-3"> 
            {!! Form::select("pickup[0][user_address_id]",[], null, ["class"=>'form-control select_add', "required"]) !!}
        </div>
        <div class="col-sm-2">
            {!! Form::text("pickup[0][pickuptime]",null, ["class"=>'form-control timepicker-new', "placeholder" => "Pickup Time", "required"]) !!}
        </div>
        <div class="col-sm-1" style=" text-align: right;">
            <a  data-value="" class="label label-danger active  DelImg delete-new-pickup" >Delete</a> 
        </div>
        <div class="col-sm-4 sub-info-block sub-info"> 
            <div class="sub-info">
                <div class="info-left">Frequency</div><div class="frequency_name"></div>
            </div>
            <div class="sub-info">
                <div class="info-left">Preferred Time Slot</div><div class="time_slot"></div>
            </div>            
            <div class="sub-info">
                <div class="info-left">Approx Processing Time</div><div class="approx_time"></div>            
            </div>
        </div> 


    </div>
</div>
@stop 

@section('myscripts')

<script>

    $(".addMore").click(function () {
        $(".existing").append($(".addNew").html());
        $('.timepicker-new').timepicker({
            timeFormat: 'hh:mm TT'
        });
        $('[name*="user_id"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][user_id]");
        });
        $('[name*="user_address_id"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][user_address_id]");
        });

        $('[name*="pickuptime"]').each(function (k, v) {
            $(this).attr("name", "pickup[" + k + "][pickuptime]");
        });

    });

    $("body").on("change", ".select_user", function () {
        var select = $(this);
        var options = $([]);
        select.parent().parent().find(".sub-info .approx_time, .sub-info .frequency_name, .sub-info .time_slot ").html('');
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
                select.parent().parent().find(".approx_time").html(data[0].approximate_processing_time);
                select.parent().parent().find(".frequency_name").html(data[0].frequency.name);
                select.parent().parent().find(".time_slot").html(data[0].timeslot.name);
            }
        });
    });

    $("body").on("click", ".delete-pickup", function () {
        var pickup_id = $(this).attr('data-id');
        var $this = $(this);
        $.ajax({
            url: "<?= route('removeSchedulePickup') ?>",
            type: "GET",
            data: {
                id: pickup_id,
            },
            success: function (response) {
                if (response.flash == 'success') {
                    $this.parent().parent().fadeOut();
                }
            }
        });
    });

    $("body").on("click", ".delete-new-pickup", function () {
        $(this).parent().parent().remove();
    });


</script>

@stop