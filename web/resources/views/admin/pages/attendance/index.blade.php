@extends('admin.layouts.default')
@section('content')
<style>
    
</style>
<section class="content-header">
    <h1>
        Attendance
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
                    <h3 class="box-title">  
                        @permission('admin.attendance.add')  
                        <!--<a href="{!! route('admin.attendance.add') !!}" class="btn btn-default" type="button">Add Attendance</a>-->      
                        @endpermission 
                        <button onclick="printDiv()" style="width: 152px;"  class="btn btn-default" type="button">Print</button>
                    </h3>
                    <div class="filter-box">

                        {!! Form::open(['method'=>'GET','route' => 'admin.attendance.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        <span>{!! Form::text('staff_id',Input::get('staff_id'), ["class"=>'form-control f1', 'placeholder'=>'Staff ID']) !!}</span>
                        <span>{!! Form::text('start_date',Input::get('start_date'), ["class"=>'form-control f2 datepicker2', 'placeholder'=>'Start Date']) !!}</span>
                        <span>{!! Form::text('end_date',Input::get('end_date'), ["class"=>'form-control f2 datepicker2', 'placeholder'=>'End Date']) !!}</span>
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
                                <th>Id</th>
                                <th class="no-print">Picture</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Date</th>
                                <th>Login Time</th>    
                                <th>Logout Time</th>    
                                <th>Working Hours</th>
                                <th class="no-print">Logout Image</th> 
                                <th class="no-print"></th>
                            </tr>
                        </thead>
                        <tbody id="indexdata">
                            <?php $index = 1; ?>
                            @foreach($attendances as $attendance)                            
                            <tr class="<?= $index % 23 == 0 ? 'page-break' : '' ?>">
                                <td>{{$attendance->user_id}}</td>
                                <td class="no-print"><img src="{{ $attendance->image ? Config('constants.uploadAttendance').$attendance->image : asset('public/Admin/dist/img/noimage.jpg') }}" style="height: 80px;" /></td>
                                <td>{{@$attendance->user->name}}</td>
                                <td>{{@$attendance->user->roles[0]->name}}</td>
                                <td>{{date('d M Y', strtotime($attendance->date))}}</td>
                                <td>{{date('h:i:s A', strtotime($attendance->created_at))}}</td> 
                                <td>{{$attendance->logout_at ? date('h:i:s A', strtotime($attendance->logout_at)) : ''}}</td> 
                                <td>{{$attendance->logout_at ? gmdate("H:i",(strtotime($attendance->logout_at) - strtotime($attendance->created_at))) : ''}}</td> 
                                <td class="no-print"><img src="{{ $attendance->logout_image ? Config('constants.uploadAttendance').$attendance->logout_image : asset('public/Admin/dist/img/noimage.jpg') }}" style="height: 80px;" /></td>
                                <td class="no-print">
                                    @permission('admin.attendance.delete')  
                                    <a href="{{ route('admin.attendance.delete',['id' => @$attendance->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>
                            </tr>

                            <?php $index++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $attendances->render() ?>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>
@stop 

@section('myscripts')

<script>
    function printDiv(printable) {
        var printContents = document.getElementById("print-content").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.title = "Mobitrash | Attendance Report";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@stop