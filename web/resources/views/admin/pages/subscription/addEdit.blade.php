@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Add New Subscription
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.subscription.view') }}"><i class="fa fa-coffee"></i>Subscription</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($subscription, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('user','Customer',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('user_id',$users,null, ["class"=>'form-control selectpicker', "data-show-content" => "false", "required", "data-live-search" => "true"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Frequency',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('frequency_id',$frequency,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Timeslot',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('timeslot',$timeslot,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Amount Paid',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amt_paid',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Max Waste',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('max_waste',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('dop','Waste Type',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('wastetype[]',$wastetype,$wastetype_selected, ["class"=>'form-control', "required", "multiple" => true]) !!}
                        </div>
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