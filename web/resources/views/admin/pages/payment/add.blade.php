@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Create New Invoice
        <small>Create/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.payment.view') }}"><i class="fa fa-coffee"></i>Payment</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    {!! Form::model($payment, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal','files'=>true ]) !!}
                    <div class="form-group">
                        {!!Form::label('subscription','Subscription',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('subscription_id',$subscription,null, ["class"=>'form-control select_subscription', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div> 
                    <div class="form-group ">
                        {!!Form::label('user','Billing Method',['class'=>'col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('billing_method', ['1'=>'Monthly Payment','2'=>'Payment against invoice'],null, ["class"=>'form-control billing_method', 'placeholder'=>'Billing Method', "disabled"]) !!}
                        </div>
                    </div> 
                    <div class="line line-dashed b-b line-lg pull-in"></div> 
                    <div class="form-group invoice_month" style="display: none;">
                        {!!Form::label('user','Month of Invoice',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('invoice_month',null, ["class"=>'form-control month-picker', 'placeholder'=>'YYYY-MM', "required"]) !!}
                        </div>
                    </div> 
                    <div class="line line-dashed b-b line-lg pull-in"></div> 
                    <div class="form-group invoice_date" style="display: none;">
                        {!!Form::label('user','Date of Invoice',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('invoice_date',null, ["class"=>'form-control datepicker', 'placeholder'=>'YYYY-MM-DD', "required"]) !!}
                        </div>
                    </div>                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('City','Amount',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('invoice_amount',null, ["class"=>'form-control invoice_amount' ,"placeholder"=>'Amount', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        {!!Form::label('email','Email',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('mail_to',null, ["class"=>'form-control user_email' ,"placeholder"=>'Email Address', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div><div class="form-group">
                        {!!Form::label('cc','CC',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('mail_to_cc','getit@mobitrash.in', ["class"=>'form-control' ,"placeholder"=>'CC']) !!}
                            <div>Add Multiple Email addresses separated by comma </div>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    
                    <div class="form-group">
                        {!!Form::label('City','Attachments',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::file('file', ["class"=>'form-control', "required"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('payment_made','Payment Made',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('payment_made',[0=>'No',1=>'Yes'],null, ["class"=>'form-control payment_made', "required"]) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div> 
                    <div class="form-group payment_date" style="display: none;">
                        {!!Form::label('user','Date of Payment',['class'=>'col-sm-2 required']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('payment_date',null, ["class"=>'form-control datepicker', 'placeholder'=>'YYYY-MM-DD', "required", "disabled"]) !!}
                        </div>
                    </div>                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>              
                    <div class="form-group payment_remark" style="display: none;">
                        {!!Form::label('City','Remark',['class'=>'col-sm-2 optional']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('remark',null, ["class"=>'form-control' ,"placeholder"=>'Remark']) !!}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>                    
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            {!! Form::hidden('id',null) !!}
                            {!! Form::hidden('added_by',Auth::id()) !!}
                            {!! Form::hidden('billing_method',null,['class'=>'billing_method']) !!}
                            {!! Form::hidden('user_id',null,['class'=>'user-id']) !!}
                            {!! Form::submit('Send Invoice',["class" => "btn btn-primary"]) !!}
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
    
    $("body").on("change", ".select_subscription", function () {
        var select = $(this);
        var date = moment().format('YYYY-MM-DD');
        $.ajax({
            url: "<?= route('getUserSub') ?>",
            type: "GET",
            data: {
                id: select.val()
            },                    
            success: function (data) { 
                $(".billing_method").val(data.billing_method);
                if(data.billing_method == 1){
                    $(".invoice_amount").val(data.amt_paid);
                    $(".invoice_month").show().find('input').prop('disabled', false);
                    $(".invoice_date").hide().find('input').prop('disabled', true);
                }else{
                    $(".invoice_amount").val('');
                    $(".invoice_date input").val(date);
                    $(".invoice_month").hide().find('input').prop('disabled', true);
                    $(".invoice_date").show().find('input').prop('disabled', false);
                }
                $(".user_email").val(data.user.email);
                $(".user-id").val(data.user_id);
            }
        });
    });
    
    $("body").on("change", ".payment_made", function () {
        if($(this).val() == 1){
            $('.payment_date, .payment_remark').show().find('input').prop('disabled', false);
        }else{
             $('.payment_date, .payment_remark').hide().find('input').prop('disabled', true);
        }        
    });

</script>

@stop