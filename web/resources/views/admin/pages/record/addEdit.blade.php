@extends('admin.layouts.default')
@section('content')
<style>
    .filelist div{
        width: 40%;
        display: inline-block;
    }
</style>
<section class="content-header">
    <h1>
        Add New Record
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.cities.view') }}"><i class="fa fa-coffee"></i>Record</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($record, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal','files'=>true ]) !!}
                    <div class="form-group">
                        {!!Form::label('user','Record Type',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('recordtype_id',$recordtypes,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Asset',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('asset_id',$vans,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        {!!Form::label('user','Date of Receipt',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('date',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>


                    <div class="form-group">
                        {!!Form::label('City','Remarks',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('remarks',null, ["class"=>'form-control' ,"placeholder"=>'Remarks', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Amount',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amt',null, ["class"=>'form-control' ,"placeholder"=>'Amount', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Quantity',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('quantity',null, ["class"=>'form-control' ,"placeholder"=>'Quantity']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Fuel Type',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('fueltype_id',$fueltypes,null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Attachments',['class'=>'col-sm-2 ']) !!}
                        <div class="col-sm-10">
                            {!! Form::file('att[]', ["class"=>'form-control' , "multiple"]) !!}
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

                    <br>
                    @foreach($record->atts->where("is_active", 1) as $at)

                    <div class="form-group filelist">
                        <div class=""><a href="{{ Config('constants.uploadRecord').$at->file }}" target="_blank">{{ $at->filename }}</a></div><a href="{{ route('admin.record.rmfile',['id' => $at->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a><div></div>
                    </div>
                    @endforeach
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