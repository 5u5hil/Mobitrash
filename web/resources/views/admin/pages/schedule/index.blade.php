@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        User Schedules
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  User Schedules</li>
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
                        {!! Form::open(['method'=>'GET','route' => 'admin.schedule.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('filter_value',$field2, ["class"=>'form-control f2 datepicker', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::select('filter_value',$vans, $field3, ["class"=>'form-control f3', "style"=>$show_f3, $dis_f3]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <a href="{!! route('admin.schedule.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Schedule</a>      
                    </h3>

                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Schedule Name</th>
                                <th>Schedule For</th>
                                <th>Van</th>
                                <th>Last Updated By</th>
                                <th>Last Updated At</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td> 
                                <td>{{ $asset->name }}</td> 
                                <td>{{ date('d M Y', strtotime($asset->for)) }}</td>
                                <td>{{ @$asset->van()->first()->name }}</td>
                                <td>{{ @$asset->addedBy()->first()->first_name }}</td>
                                <td>{{ date('d M Y', strtotime($asset->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.schedule.show',['id' => $asset->id ])  }}"  class="label label-success active" ui-toggle-class="">view</a>
                                    <a href="{{ route('admin.schedule.edit',['id' => $asset->id ])  }}"  class="label label-success active" ui-toggle-class="">Edit</a>
                                    <a href="{{ route('admin.schedule.duplicate',['id' => $asset->id ])  }}" class="label label-primary active" onclick="return confirm('Schedule will duplicated for next day of schedule date! Are you sure?')" ui-toggle-class="">Duplicate</a>
                                    <a href="{{ route('admin.schedule.delete',['id' => $asset->id ])  }}"  class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $schedule->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 


@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'name') {
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'for') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3").hide().prop('disabled', true);
        } else if ($(this).val() == 'van_id') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2").hide().prop('disabled', true);
        } else{
            $(".f1, .f2, .f3").hide().prop('disabled', true);
        }
    });
</script>

@stop