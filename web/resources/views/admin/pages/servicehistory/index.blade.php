@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Service History
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Service History</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        <!--<a href="{!! route('admin.servicehistory.add') !!}" class="btn btn-default" type="button">Add New Service History</a>-->      
                        <button onclick="printDiv()" style="width: 142px;"  class="btn btn-primary" type="button">Print</button>
                        <a href="{!! route('admin.servicehistory.excel') !!}?filter_type={{Input::get('filter_type')}}&filter_value={{Input::get('filter_value')}}&start_date={{Input::get('start_date')}}&end_date={{Input::get('end_date')}}" style="width: 142px;" class="btn btn-default" type="button">Export</a>
                    </h3>

                    <div class="filter-box">

                        <?php
                        $show_f1 = 'display:none;';
                        $show_f2 = 'display:none;';
                        $show_f4 = 'display:none;';
                        $dis_f1 = 'disabled';
                        $dis_f2 = 'disabled';
                        $dis_f3 = 'disabled';
                        $dis_f4 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        if ($field2) {
                            $show_f2 = '';
                            $dis_f2 = '';
                        }
                        if ($field4) {
                            $show_f4 = '';
                            $dis_f4 = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.servicehistory.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::select('filter_value',$vans,$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::select('filter_value',$operators,$field2, ["class"=>'form-control f2 ', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::select('filter_value', $subscriptions, $field4, ["class"=>'form-control f4', "style"=>$show_f4, $dis_f4]) !!}
                        {!! Form::text('start_date', Input::get('start_date'), ["class"=>'form-control datepicker2', "placeholder" => "Start Date"]) !!}
                        {!! Form::text('end_date', Input::get('end_date'), ["class"=>'form-control datepicker2', "placeholder" => "End Date"]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>


                    <div class="message-box">
                        <p style="color:red;text-align: center">{{ Session::get('message') }}  </p>
                    </div>

                </div>

                <div id="print-content" class="box-body table-responsive no-padding print">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Van</th>
                                <th>Staff Name</th>
                                <th style="min-width: 88px;">Date</th>
                                <th style="width: 160px;">User Subscription</th>
                                <th style="min-width: 135px;">Waste Collected</th>
                                <th style="min-width: 125px;">Additives</th>
                                <th>Time Taken</th>
                                <th>No of Crates</th>
                                <th class="no-print"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{@$service->schedule->van->name}} - {{@$service->schedule->van->asset_no}}</td>
                                <td>
                                    <div>{{$service->operator->name}}</div>

                                </td>
                                <td><div>{{date('d M Y', strtotime($service->created_at))}}</div><div>{{date('h:i:s A', strtotime($service->created_at))}}</div></td>
                                <td>{{@$service->subscription->name}}</td>                                
                                <td>@foreach($service->wastetypes as $waste)
                                    <div>{{@$waste->name}} : {{@$waste->pivot->quantity}} kg</div>
                                    @endforeach
                                </td>
                                <td> 
                                    @foreach($service->additives as $additive)
                                    <div>{{@$additive->name}} : {{@$additive->pivot->quantity}} kg</div>
                                    @endforeach</td>
                                <td>{{$service->time_taken}}</td>
                                <td>{{$service->crates_filled}}</td>
                                <td class="no-print">
                                    @permission('admin.servicehistory.edit')
                                    <a href="{{ route('admin.servicehistory.edit',['id' => $service->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.servicehistory.delete')
                                    <a href="{{ route('admin.servicehistory.delete',['id' => $service->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $services->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>

@stop 


@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'van_id') {
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3, .f4").hide().prop('disabled', true);
        } else if ($(this).val() == 'operator_id') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3, .f4").hide().prop('disabled', true);
        } else if ($(this).val() == 'created_at') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2, .f4").hide().prop('disabled', true);
        } else if ($(this).val() == 'subscription_id') {
            $(".f4").show().prop('disabled', false);
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3, .f4").hide().prop('disabled', true);
        }
    });
    function printDiv(printable) {
        var printContents = document.getElementById("print-content").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.title = "Mobitrash | Service History";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@stop