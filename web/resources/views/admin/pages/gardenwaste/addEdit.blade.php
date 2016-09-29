@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Garden Waste Pickup
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.gardenwaste.view') }}"><i class="fa fa-coffee"></i>Garden Waste Pickup</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! Form::model($pickup, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('Date','Pickup Date',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('pickup_date',null, ["class"=>'form-control datepicker', "required", "placeholder"=>"Pickup Date"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Garden Gunny Bags',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('gunny_bags',null, ["class"=>'form-control', "required", "placeholder"=>"Garden Gunny Bags"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Amount',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amount',null, ["class"=>'form-control', "required", "placeholder"=>"Amount"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Pickup Status',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::Select('pickup_status',['Request Received'=>'Request Received', 'Processing'=> 'Processing', 'Successful'=>'Successful'], null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Pickup Attempted At',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('pickup_attempted_at',null, ["class"=>'form-control datetimepicker',  "placeholder"=>"Pickup Attempted At"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Payment Made',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::Select('payment_made',['0'=>'No', '1'=>'Yes'], null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('Date','Remark',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('Remark',null, ["class"=>'form-control', "placeholder"=>"Remark"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            {!! Form::hidden('id',null) !!}
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

</script>

@stop