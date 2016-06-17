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
                        {!!Form::label('dop','Subscription Name',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
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
                        {!!Form::label('user','Occupancy Type',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('occupancy_id',$occupancy,null, ["class"=>'form-control', "data-show-content" => "false", "required"]) !!}
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
                        {!!Form::label('user','Prefered Timeslot',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('prefered_timeslot',null, ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div> 
                    <div class="line line-dashed b-b line-lg pull-in"></div>   
                    <div class="form-group">
                        {!!Form::label('dop','Billing Method',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('billing_method',[''=>'Select Billing Method',1=>'Monthly Payment',2=>'Payment against invoice'],null, ["class"=>'form-control bulling-method', "required"]) !!}
                        </div>
                    </div>                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group billing-amount" style="{{$subscription->billing_method==1 ? 'display:block;': 'display:none;'}}">
                        {!!Form::label('dop','Amount',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('amt_paid',null, ["class"=>'form-control']) !!}
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
                            {!! Form::select('wastetype[]',$wastetype,$wastetype_selected, ["class"=>'form-control', "required", "multiple"]) !!}
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
                        {!!Form::label('dop','Return of Compost',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('return_of_compost',[0 => "No", 1 => "Yes"],null, ["class"=>'return-of-compost form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group weekly-quantity" style="{{$return_of_compost? 'display:block;': 'display:none;'}}">
                        {!!Form::label('dop','Weekly Quantity',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('weekly_quantity',null, ["class"=>'form-control']) !!}
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
                        {!!Form::label('dop','On field Person Name',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('onfield_person_name',null, ["class"=>'form-control', "id"=>"person_name", "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','On field Person Contact Number',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('onfield_person_contact_number',null, ["class"=>'form-control', "id"=>"person_number", "required"]) !!}
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
                        {!!Form::label('dop','Remark',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('remark',null, ["class"=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('dop','Tial',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('is_trial',[0 => "No", 1 => "Yes"],null, ["class"=>'return-of-compost form-control']) !!}
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
                        <div class=""><a href="{{ Config('constants.uploadRecord').$at->file }}" target="_blank">{{ $at->filename }}</a></div><a href="{{ route('admin.record.rmfile',['id' => $at->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a><div></div>
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
                $.each(data.addresses, function (k, v) {
                    $('#person_name').val(data.name);
                    $('#person_number').val(data.phone_number);
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
    
    $('.return-of-compost').change(function(){
        if($(this).val() == '1'){
            $('.weekly-quantity').show();
        }else{
            $('.weekly-quantity').hide();
            $('.weekly-quantity input').val('');
        }
    });
    
    $('.bulling-method').change(function(){
        if($(this).val() == 1){
            $('.billing-amount').show();
        }else{
            $('.billing-amount').hide();
            $('.billing-amount input').val('');
        }
    });

</script>

@stop