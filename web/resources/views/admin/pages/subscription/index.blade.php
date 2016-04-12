@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        User Subscriptions
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  User Subscriptions</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        <a href="{!! route('admin.subscription.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Subscription</a>      
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
                                <th>User</th>
                                <th>Preferred Timeslot</th>
                                <th>Frequency</th>
                                <th>Amount Paid</th>
                                <th>Start Date</th>
                                <th>End Date</th>    
                                <th>Max Waste Quantity</th>    
                                <th>Waste Type</th>    
                                <th>Subscribed On</th>
                                <th>Last Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscription as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ @$asset->user()->first()->first_name }}</td>
                                <td>{{ @$asset->timeslot()->first()->name }}</td>
                                <td>{{ @$asset->frequency()->first()->name }}</td>
                                <td>{{ $asset->amt_paid }}</td>
                                <td>{{ date('d M Y', strtotime($asset->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($asset->end_date)) }}</td>
                                <td>{{ $asset->max_waste }}</td>
                                <td>{{ $asset->wastetypes[0]->name}}</td>
                                <td>{{ date('d M Y', strtotime($asset->created_at)) }}</td>
                                <td>{{ @$asset->addedBy()->first()->first_name }}</td>

                                <td>
                                    <a href="{{ route('admin.subscription.edit',['id' => $asset->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>                                
                                    <a href="{{ route('admin.subscription.delete',['id' => $asset->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $subscription->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 