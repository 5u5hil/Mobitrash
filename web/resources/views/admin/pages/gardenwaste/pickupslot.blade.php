@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Garden Waste Pickup Slots
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Garden Waste Pickup Slots</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div style="text-align: center;">
                        <p style="color:green;">{{ Session::get('message') }}</p>
                        <div style="color:red;"><?php echo Session::get('messageError'); ?></div>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}

                    <div class="form-group">
                        {!!Form::label('user','Select Pickup Date',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            <div class="multidatepicker"></div>
                            {!! Form::text('multiple_dates',$pickupslots, ["class"=>'form-control', "style"=>"display:none", "id"=>"multiple-dates", 'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                            <div class="date-error" style="color:red;padding: 5px 0px;"></div>
                        </div>
                    </div>
                    
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
    var selected = <?= $pickupslots ?>;
    var default_date = new Date();
    $('.multidatepicker').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        defaultDate: default_date,
        altField: "#multiple-dates",
        minDate: default_date,
        addDates: selected
    });
    
    $("input:submit").click(function(){
        
        var schedule_date = $('#multiple-dates').val();
        if(!schedule_date){
            $('.date-error').html('Please select at least one Pickup Date');
        }
        else{
            $('.date-error').html('');
        }
    });
    
    
</script>

@stop 