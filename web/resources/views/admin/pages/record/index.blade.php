@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Record
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Record</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        <a href="{!! route('admin.record.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Record</a>      
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
                                <th>Record Type</th>
                                <th>Record For</th>
                                <th>Remarks</th>
                                <th>Receipt Date</th>
                                <th>Last Updated By</th>
                                <th>Last Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach($record as $city)
                            
                            <tr>
                                <td>{{ @$city->id }}</td>
                                <td>{{ @$city->rtype->name }}</td>
                                <td>{{ @$city->asset->name ." " . $city->asset->asset_no }}</td>
                                <td>{{ $city->remarks }}</td>
                                <td>{{ date("d M Y",strtotime($city->date)) }}</td>
                                <td>{{ @$city->addedBy->first_name }}</td>
                                <td>{{ date("d M Y",strtotime($city->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.record.edit',['id' => $city->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.record.delete',['id' => $city->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $record->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 