@extends('admin.layouts.default')




@section('content')

<section class="content-header">
    <h1>
        Miscellaneous
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.miscellaneous.view') }}"><i class="fa fa-coffee"></i>Settings</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! Form::model($setting, ['method' => 'post', 'files'=> true, 'url' => $action , 'class' => 'form-horizontal' ]) !!}

                    <div class="form-group">
                        {!! Form::label('Name', 'Name',['class'=>'col-sm-2 control-label']) !!}
                        {!! Form::hidden('id',null) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'Enter Name', "required"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Value', 'Value',['class'=>'col-sm-2 control-label']) !!}
                     
                        <div class="col-sm-10">
                            {!! Form::text('value',null, ["class"=>'form-control' ,"placeholder"=>'Enter Value', "required"]) !!}
                        </div>
                    </div>


                
                      <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            {!! Form::submit('Submit',["class" => "btn btn-primary pull-right"]) !!}
                            {!! Form::close() !!}     


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@stop

