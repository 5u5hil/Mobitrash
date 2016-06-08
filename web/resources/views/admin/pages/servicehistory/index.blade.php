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
                        {!! Form::open(['method'=>'GET','route' => 'admin.servicehistory.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::select('filter_value',$vans,$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::select('filter_value',$operators,$field2, ["class"=>'form-control f2 ', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::text('filter_value', $field3, ["class"=>'form-control f3 datepicker2', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <!--<a href="{!! route('admin.servicehistory.add') !!}" class="btn btn-default pull-right" type="button">Add New Service History</a>-->      
                    </h3>

                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}  </p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Van</th>
                                <th>Staff Names</th>
                                <th style="min-width: 88px;">Date</th>
                                <th style="width: 160px;">Username & Address</th>
                                <th style="min-width: 125px;">Additives</th>
                                <th style="min-width: 135px;">Waste Collected</th>
                                <th>Time Taken</th>
                                <th>Compost</th>
                                <th>No of Crates</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{@$service->schedule->van->name}} - {{@$service->schedule->van->asset_no}}</td>
                                <td>@foreach($service->schedule->operators as $operator)
                                    <div>{{$operator->name}}</div>
                                    @endforeach
                                </td>
                                </td>
                                <td><div>{{date('d M Y', strtotime($service->created_at))}}</div><div>{{date('h:i:s A', strtotime($service->created_at))}}</div></td>
                                <td><div>{{@$service->user->name}}</div><div>{{@$service->address->address}}</div></td>
                                <td> 
                                    @foreach($service->additives as $additive)
                                    <div>{{@$additive->name}} : {{@$additive->pivot->quantity}} kg</div>
                                    @endforeach</td>
                                <td>@foreach($service->wastetypes as $waste)
                                    <div>{{@$waste->name}} : {{@$waste->pivot->quantity}} kg</div>
                                    @endforeach
                                </td>
                                <td>{{$service->time_taken}}</td>
                                <td>{{$service->compost}}</td>
                                <td>{{$service->crates_filled}}</td>
                                <td>
                                    <!--<a href="{{ route('admin.servicehistory.edit',['id' => $service->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>-->
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
            $(".f2, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'operator_id') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'created_at') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop