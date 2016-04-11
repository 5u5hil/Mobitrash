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
                                    <a href="{{ route('admin.schedule.duplicate',['id' => $asset->id ])  }}" class="label label-primary active" onclick="return confirm('Schedule will duplicated for next day! Are you sure?')" ui-toggle-class="">Duplicate</a>
                                    <a href="{{ route('admin.schedule.delete',['id' => $asset->id ])  }}"  class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $schedule->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 