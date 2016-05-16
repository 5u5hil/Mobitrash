@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Payment
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Payment</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="filter-box">
                        <?php
                        $show_f1 = 'display:none;';
                        $show_f2 = 'display:none;';
                        $show_f3 = 'display:none;';
                        $dis_f1 = 'disabled';
                        $dis_f2 = 'disabled';
                        $dis_f3 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        if ($field2) {
                            $show_f2 = '';
                            $dis_f2 = '';
                        }
                        if ($field3) {
                            $show_f3 = '';
                            $dis_f3 = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.payment.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('filter_value', $field2, ["class"=>'form-control f2 datepicker2', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::text('filter_value',$field3, ["class"=>'form-control f3 monthpicker', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <a href="{!! route('admin.payment.add') !!}" class="btn btn-default pull-right" type="button">Create New Invoice</a>      
                    </h3>
                    <div>
                        <p style="color:green;text-align: center">{{ @Session::pull('message') }}</p>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Subscription</th>
                                <th>Subscriber Name</th>
                                <th>Invoice Date/Month</th>
                                <th>Invoice Amount</th>                                
                                <th>Payment Made</th>
                                <th>Payment Date</th>
                                <th>Remark</th>
                                <th>Attachment</th>
                                <th>Added By</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">                          
                            @foreach($payments as $payment)                            
                            <tr>
                                <td>{{@$payment->id}}</td>
                                <td>{{@$payment->subscription->name}}</td>
                                <td>{{@$payment->user->name}}</td>
                                <td>{{@$payment->billing_method == 1 ? date('M Y', strtotime($payment->invoice_month)) : date('d M Y', strtotime($payment->invoice_date))}}</td>
                                <td>{{@$payment->invoice_amount}}</td>                                
                                <td>{{@$payment->payment_made == 1? 'Yes' : 'No'}}</td>
                                <td>{{ date('d M Y', strtotime(@$payment->payment_date)) }}</td>
                                <td>{{@$payment->remark}}</td>
                                <td>  
                                    <a href="{{ Config('constants.uploadRecord').@$payment->file }}" target="_BLANK"><i class="fa fa-file"></i></a>
                                </td>
                                <td>{{@$payment->addedBy->name}}</td>
                                <td>
                                    <a href="{{ route('admin.payment.edit',['id' => @$payment->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    <a href="{{ route('admin.payment.delete',['id' => @$payment->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $payments->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'subscription_name') {
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'invoice_date') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'invoice_month') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else{
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop