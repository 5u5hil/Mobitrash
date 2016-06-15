@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Add New Servicetype
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.servicetype.view') }}"><i class="fa fa-coffee"></i>Servicetype</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($service, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('Waste','Waste Collected',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            @foreach($wastetype as $waste)
                            <div style="margin-top: 5px;">{{@$waste['name']}}</div>
                            {!! Form::number("wastetype[".$waste['id']."][quantity]",$waste['value'], ["class"=>'form-control' ,"placeholder"=>"Qty in kg"]) !!}
                            @endforeach
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('Additives','Additives',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            @foreach($additives as $addt)
                            <div style="margin-top: 5px;">{{@$addt['name']}}</div>
                            {!! Form::number("additive[".$addt['id']."][quantity]",$addt['value'], ["class"=>'form-control' ,"placeholder"=>"Qty in kg"]) !!}
                            @endforeach
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('No of Crates','No of Crates',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::number('crates_filled',null, ["class"=>'form-control', "placeholder"=>"No of Crates"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('time_taken','Time Taken',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('time_taken',null, ["class"=>'form-control timepicker', "placeholder"=>"Time Taken"]) !!}
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

    $("[name='chkAll']").click(function (event) {
        var checkbox = $(this);
        var isChecked = checkbox.is(':checked');
        if (isChecked) {
            $("[name='chk[]']").attr('Checked', 'Checked');
        } else {
            $("[name='chk[]']").removeAttr('Checked');
        }
    });

</script>

@stop