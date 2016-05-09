@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Attendance
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Attendance</li>
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
                        $dis_f1 = 'disabled';
                        $dis_f2 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        if ($field2) {                            
                            $show_f2 = ''; 
                            $dis_f2 = '';
                        }                  
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.attendance.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        {!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}
                        {!! Form::text('filter_value',$field1, ["class"=>'form-control f1', "style"=>$show_f1, $dis_f1]) !!}
                        {!! Form::text('filter_value',$field2, ["class"=>'form-control f2 datepicker', "style"=>$show_f2, $dis_f2]) !!}
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  
                        <!--<a href="{!! route('admin.attendance.add') !!}" class="btn btn-default pull-right" type="button">Add Attendance</a>-->      
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
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Date</th>
                                <th>Created At</th>    
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">                          
                            @foreach($attendances as $attendance)                            
                            <tr>
                                <td>{{$attendance->id}}</td>
                                <td><img src="{{ $attendance->image ? Config('constants.uploadAttendance').$attendance->image : asset('public/Admin/dist/img/noimage.jpg') }}" style="height: 80px;" /></td>
                                <td>{{@$attendance->user->name}}</td>
                                <td>{{@$attendance->user->roles[0]->name}}</td>
                                <td>{{date('d M Y', strtotime($attendance->date))}}</td>
                                <td>{{date('d M Y h:i:s A', strtotime($attendance->created_at))}}</td> 
                                <td>
                                    
                                    <a href="{{ route('admin.attendance.delete',['id' => @$attendance->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $attendances->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'user_id') {
            $(".f1").show().prop('disabled', false);
            $(".f2").hide().prop('disabled', true);
        } else if ($(this).val() == 'date') {
            $(".f2").show().prop('disabled', false);
            $(".f1").hide().prop('disabled', true);
        } else{
            $(".f1, .f2").hide().prop('disabled', true);
        }
    });
</script>

@stop