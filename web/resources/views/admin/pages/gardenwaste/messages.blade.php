@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Customers Messages
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Customers Messages</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title action-box"> 
                        
                    </h3>
                    <div class="filter-box">
                        
                    </div>

                    <div class="message-box">
                        <p style="color:green;text-align: center">{{ @Session::pull('message') }}</p>
                    </div>
                </div>

                <div id="print-content" class="box-body table-responsive no-padding print">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th style="width: 300px;">Message</th>                                
                                <th>Created At</th>                                
                                <!--<th class="no-print"></th>-->
                            </tr>
                        </thead>
                        <tbody id="indexdata">                          
                            @foreach($messages as $message)                            
                            <tr>
                                <td>{{@$message->id}}</td>
                                <td>{{@$message->user->name}}</td>
                                <td>{{@$message->user->email }}</td>
                                <td>{{@$message->msg}}</td>
                                <td>{{@$message->created_at ? date('d M Y h:m A', strtotime($message->created_at)) : ''}}</td>
<!--                                <td  class="no-print">
                                   
                                </td>-->

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $messages->render() ?>
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