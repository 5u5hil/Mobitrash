@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Bonfleet
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.bonfleet.view') }}"><i class="fa fa-coffee"></i>Bonfleet</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($bonfleet, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('Bonfleet Id','Bonfleet Id',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('bonfleet_id',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('Name','Name',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'Asset Name', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('Amount','Amount',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amount',null, ["class"=>'form-control' ,"placeholder"=>'Amount', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>


                    <div class="form-group">
                        {!!Form::label('Balance','Balance',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('balance',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('event','Event',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('event',null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('merchant','Merchant',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('merchant',null, ["class"=>'form-control', 'placeholder'=>'Merchant']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('phone','Phone',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('phone',null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('card4','Card',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('card4',null, ["class"=>'form-control', 'placeholder'=>'Card']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('time','UTS',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('uts',null, ["class"=>'form-control', 'placeholder'=>'UTS']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('meta','Meta',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('meta',null, ["class"=>'form-control', 'placeholder'=>'Meta']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('litres','Litres',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('litres',null, ["class"=>'form-control', 'placeholder'=>'Litres']) !!}
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