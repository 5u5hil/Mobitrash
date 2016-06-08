@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Timeslot
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Timeslot</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        @permission('admin.timeslot.add')
                        <a href="{!! route('admin.timeslot.add') !!}" class="btn btn-default pull-right" type="button">Add New Timeslot</a>      
                        @endpermission
                    </h3>

                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Timeslot</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slot Type</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timeslot as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->start_time }}</td>
                                <td>{{ $city->end_time }}</td>
                                <td>{{ ($city->type == 0 ? 'Both' : ($city->type == 1 ? 'Operator Shift' :'User Pickup Time' )) }}</td>
                                <td>{{ $city->is_active == 1 ? 'Yes' : 'No' }}</td>

                                <td>
                                    @permission('admin.timeslot.edit')
                                    <a href="{{ route('admin.timeslot.edit',['id' => $city->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.timeslot.delete')
                                    <a href="{{ route('admin.timeslot.delete',['id' => $city->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $timeslot->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 