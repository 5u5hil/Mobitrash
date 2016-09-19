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
                    <h3 class="box-title action-box"> 
                        @permission('admin.payment.add')
                        <a href="{!! route('admin.payment.add') !!}" class="btn btn-default" type="button">Create New Invoice</a>      
                        @endpermission                        
                        <button onclick="printDiv()" style="width: 142px;"  class="btn btn-default" type="button">Print</button>
                        @permission('admin.payment.excel')
                        <a href="{!! route('admin.payment.excel') !!}?filter_type={{Input::get('filter_type')}}&filter_value={{Input::get('filter_value')}}&invoice_date={{Input::get('invoice_date')}}&invoice_month={{Input::get('invoice_month')}}" style="width: 142px;" class="btn btn-default" type="button">Export</a>
                        @endpermission
                    </h3>
                    <div class="filter-box">
                        <?php
                        $show_f1 = 'display:none;';
                        $dis_f1 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.payment.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('invoice_date', Input::get('invoice_date'), ["class"=>'form-control  datepicker2 date-select', 'placeholder' => 'Date']) !!}
                        {!! Form::text('invoice_month',Input::get('invoice_month'), ["class"=>'form-control  month-picker month-select', 'placeholder' => 'Month']) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="message-box">
                        <p style="color:green;text-align: center">{{ @Session::pull('message') }}</p>
                    </div>
                </div>

                <div id="print-content" class="box-body table-responsive no-padding print">
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
                                <th class="no-print">Attachment</th>
                                <th>Added By</th>
                                <th>Txn Details</th>
                                <th class="no-print"></th>
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
                                <td>{{@$payment->payment_made == 1? 'Yes' : ($payment->payment_made == 2 ? 'Pending' :'No')}}</td>
                                <td>{{ ($payment->payment_made == 1 || $payment->payment_made == 2) ? date('d M Y', strtotime(@$payment->payment_date)) : '-' }}</td>
                                <td>{{@$payment->remark}}</td>
                                <td class="no-print">  
                                    <a href="{{ Config('constants.uploadRecord').@$payment->file }}" target="_BLANK"><i class="fa fa-file"></i></a>
                                </td>
                                <td>{{@$payment->addedBy->name}}</td>

                                <td style="font-size: 10px;">
                                    @if(!empty( $payment->txtdetails))
                                    <?php
                                    $txn = json_decode($payment->txtdetails);
                                    unset($txn->CHECKSUMHASH)
                                    ?>
                                    <!--{{ json_encode($txn, JSON_PRETTY_PRINT)}};-->
                                    @foreach($txn as $key=>$tx)
                                    <div style="display: table-row;">
                                    <div style="display: table-cell;min-width: 105px;">
                                        {{$key}} :
                                    </div>
                                    <div style="display: table-cell;">
                                        {{$tx}}
                                    </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </td>
                                <td  class="no-print">
                                    @permission('admin.payment.edit')
                                    <a href="{{ route('admin.payment.edit',['id' => @$payment->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.payment.delete')
                                    <a href="{{ route('admin.payment.delete',['id' => @$payment->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
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
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
    $('.date-select').change(function () {
        $('.month-select').val('');
    });
    $('.month-select').change(function () {
        $('.date-select').val('');
    });

    function printDiv(printable) {
        var printContents = document.getElementById("print-content").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.title = "Mobitrash | Payments";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@stop