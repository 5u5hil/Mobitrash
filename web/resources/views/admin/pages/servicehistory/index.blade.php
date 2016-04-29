@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Service History
        <small>Add/Edit/Delete</small>
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
                        <a href="{!! route('admin.servicehistory.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Service History</a>      
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
                                <th>Van</th>
                                <th>Staff Names</th>
                                <th style="min-width: 88px;">Date</th>
                                <th>Username & Address</th>
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
                                <td>@foreach(@$service->schedule->operators as $operator)
                                    <div>{{@$operator->name}}</div>
                                    @endforeach
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
                                    <!--<a href="{{ route('admin.servicehistory.edit',['id' => $service->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>-->
                                    <a href="{{ route('admin.servicehistory.delete',['id' => $service->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
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