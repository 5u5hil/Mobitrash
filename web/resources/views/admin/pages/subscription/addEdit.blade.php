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

                    {!! Form::model($subscription, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal', 'files'=>true ]) !!}
                    <div class="form-group">
                        {!!Form::label('user','Customer',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('user_id',$users,null, ["class"=>'form-control selectpicker select_user', "data-show-content" => "false", "required", "data-live-search" => "true"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Customer Address',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('user_address_id',[],null, ["class"=>'form-control select_add', "data-show-content" => "false", "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Frequency',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('frequency_id',$frequency,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Timeslot',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('timeslot_id',$timeslot,null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div> 
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('user','Package',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('package_id',$packages, null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div> 
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Amount Paid',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amt_paid',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Paid On',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('paid_on',null, ["class"=>'form-control datepicker', 'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Max Waste quantity (kg)',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('max_waste',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Waste Type',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('wastetype[]',$wastetype,$wastetype_selected, ["class"=>'form-control', "required", "multiple" => true]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Start Date',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('start_date',null, ["class"=>'form-control datepicker', 'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','End Date',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('end_date',null, ["class"=>'form-control datepicker',  'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Approximate Processing Time',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('approximate_processing_time',null, ["class"=>'form-control timepicker', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Attachments',['class'=>'col-sm-2 optional']) !!}
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
                    @foreach($subscription->atts->where("is_active", 1) as $at)
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
    
    $(".select_user").change(function () {
        var select = $(this);
        var options = '';
        $.ajax({
            url: "<?= route('getUserAdd') ?>",
            type: "GET",
            data: {
                uid: select.val()
            },
            success: function (data) {
                $.each(data, function (k, v) {
                    var selected = '';
                    <?php 
                    if($subscription->user_address_id){echo "var addressid = ".$subscription->user_address_id.";"; }else { echo 'var addressid = 0;';}
                    ?>
                    if(v.id == addressid){
                        selected = 'selected';
                    }
                    var opt = '<option value="'+v.id+'" '+selected+'>'+v.address+'</option>';
                    options += opt;
                });
                $(".select_add").html(options);
            }
        });
    }).change();

</script>

@stop