@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Settings
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div style="text-align: center;">
                        <p style="color:green;">{{ Session::get('messageSuccess') }}</p>
                        <div style="color:red;"><?php echo Session::get('messageError'); ?></div>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::model($configuration, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}

                    <div class="form-group">
                        {!!Form::label('user','Van Password',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('van_password',null, ["class"=>'form-control', 'placeholder'=>'Van Password', "required"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('user','Gunny Bag Price',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('gunny_bag_price',null, ["class"=>'form-control', 'placeholder'=>'Gunny Bag Price', "required"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('user','Garden Waste Pickup Price',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('garden_waste_pickup_price',null, ["class"=>'form-control', 'placeholder'=>'Garden Waste Pickup Price', "required"]) !!}
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