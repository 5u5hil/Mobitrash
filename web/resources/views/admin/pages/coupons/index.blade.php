@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
        Coupons
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Coupons</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div>
            <p style="color: red;text-align: center;">{{ Session::get('messege') }}</p>
        </div>
        
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">   <a href="{!! route('admin.coupons.add') !!}" class="btn btn-default pull-right" type="button">Add New Coupon</a> </h3>
                </div>
                
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Coupon ID</th>
                                <th>Coupon Image</th>
                                <th>Coupon Name</th>
                                <th>Coupon Code</th>
                                <th>Discount Type</th>
                                <th>Coupon Value</th>
                                <th>Min Order Amt</th>
                                <th>Coupon Type</th>
                                <th>Coupon Desc</th>
                                <th>Number of Times</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>User Specific</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couponInfo as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td><img class="img-responsive img-thumbnail" style="width:60%;" src="/inficart/public/Admin/uploads/coupons/{{ $coupon->coupon_image }}" /></td>
                                <td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->coupon_code}}</td>
                                <td>{{$coupon->discount_type}}</td>
                                <td>{{$coupon->coupon_value}}</td>
                                <td>{{$coupon->min_order_amt}}</td>
                                <td>{{$coupon->coupon_type}}</td>
                                <td>{{$coupon->coupon_desc}}</td>
                                <td>{{$coupon->no_times_allowed}}</td>
                                <td>{{$coupon->start_date}}</td>
                                <td>{{$coupon->end_date}}</td>
                                <td>{{$coupon->user_specific}}</td>
                                <td>{{$coupon->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.coupons.edit',['id'=>$coupon->id])}}" class="label label-success active" ui-toggle-class="">Edit</a> 
                                    <a href="{!! route('admin.coupons.delete',['id'=>$coupon->id]) !!}" class="label label-danger active" ui-toggle-class="" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

@stop 
@section('myscripts')
<script>
  $(function() {
    $( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
     $( "#todatepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  });
</script>
@stop