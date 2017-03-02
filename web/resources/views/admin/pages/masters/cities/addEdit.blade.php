@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Add New City
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.cities.view') }}"><i class="fa fa-coffee"></i>City</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($city, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
                    <div class="form-group">
                        {!!Form::label('City','City',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'City Display Name', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Pipeline Id',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('pipeline_id', $pipelines,null, ["class"=>'form-control pipeline_id', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Pipeline Stage for Inquiry',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('inquiry_stage_id', $stages,null, ["class"=>'form-control stages', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Pipeline Stage for Trial Deals',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('stage_id', $stages,null, ["class"=>'form-control stages', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('Garden Waste','Garden Waste',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('garden_waste',[1 => "Yes", 0 => "No"],null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('Active','Active',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('is_active',[1 => "Yes", 0 => "No"],null, ["class"=>'form-control']) !!}
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
    
    $('.pipeline_id').change(function(){
        var id = $(this).val();
        $('.stages').html('');
        $.ajax({
            url: "<?= route('admin.pipedrive.stages') ?>",
            type: "GET",
            data: {
                id: id,
            },
            success: function (response) {
                if (response.flash == 'success') {
                    var options = '<option>Select Pipeline Stage</option>';
                    $.each(response.stages, function(key,stage){
                        options += '<option value="'+stage.id+'">'+stage.name+'</option>';
                    });
                    $('.stages').html(options);
                }
            }
        });
    });

</script>

@stop