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