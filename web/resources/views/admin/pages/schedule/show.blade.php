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
                        {!!Form::label('user','Schedule Name',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','For',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('for',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Van',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('van_id',$vans,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Operators',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('operators[]',$users,$ops, ["class"=>'form-control', "required", "multiple" => true]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <h4>Pickups</h4>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="row clearfix" >
                        <div class="col-sm-2 pull-right">
                            <a href="javascript:void();" class="label label-success active addMore" >Add a Pickup</a> 
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
                            <div class="col-sm-3">
                                {!! Form::text('address',$pickup->approximate_processing_time, ["class"=>'form-control', "readonly"]) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::datetime("pickup[$key][pickuptime]",$pickup->pickuptime, ["class"=>'form-control', "required"]) !!}
                                {!! Form::hidden("pickup[$key][user_id]",$pickup->user_id) !!}
                                {!! Form::hidden("pickup[$key][user_address_id]",$pickup->user_address_id) !!}
                                {!! Form::hidden("pickup[$key][approximate_processing_time]",$pickup->approximate_processing_time) !!}

                            </div> 
                            <div class="col-sm-1" style=" text-align: right;">
                                <a  data-value="" href="javascript:void();" class="label label-danger active  DelImg" >Delete</a> 
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
        options = options.add($("<option />", {text: 'Select Address', value:''}));
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
        var userid =  select.parent().parent().find(".select_user").val();
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