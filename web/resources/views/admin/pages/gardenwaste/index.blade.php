@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Garden Waste Pickups
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Garden Waste Pickups</li>
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
                                <th>Pickup Date</th>
                                <th>Customer</th>
                                <th style="width: 195px;">Address</th>
                                <th>Gunny Bags</th>
                                <th>Amount</th>
                                <th>Pickup Done</th>                                
                                <th>Payment Made</th>
                                <th>Created At</th>                                
                                <th class="no-print"></th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">                          
                            @foreach($pickups as $pickup)                            
                            <tr>
                                <td>{{@$pickup->id}}</td>
                                <td>{{@$pickup->pickup_date ? date('d M Y', strtotime($pickup->pickup_date)) : ''}}</td>
                                <td>{{@$pickup->user->name}}</td>
                                <td>{{@$pickup->address->address_line_1. ' '. @$pickup->address->address_line_2. ' '. @$pickup->address->locality. ' '. @$pickup->address->city. ' '. @$pickup->address->pincode }}</td>
                                <td>{{@$pickup->gunny_bags}}</td>
                                <td>{{@$pickup->amount}}</td>  
                                <td>{{@$pickup->is_picked_up == 1? 'Yes' : 'No'}}</td>
                                <td>{{@$pickup->payment_status == 1? 'Yes' : 'No'}}</td>
                                <td>{{@$pickup->created_at}}</td>
                                <td  class="no-print">
                                    @permission('admin.gardenwaste.edit')
                                    <a href="{{ route('admin.gardenwaste.edit',['id' => @$pickup->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.gardenwaste.delete')
                                    <a href="{{ route('admin.gardenwaste.delete',['id' => @$pickup->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= @$pickups->render() ?>
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