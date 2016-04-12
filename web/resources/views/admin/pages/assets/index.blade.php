@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Assets Management
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Assets Management</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        <a href="{!! route('admin.assets.add') !!}" class="btn btn-default pull-right" target="_" type="button">Add New Asset</a>      
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
                                <th>Name</th>
                                <th>Asset No.</th>
                                <th>Type</th>
                                <th>Part Of</th>
                                <th>City</th>
                                <th>DOP</th>
                                <th>Active</th>
                                <th>Last Updated By</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->asset_no }}</td>
                                <td>{{ @$asset->type()->first()->name }}</td>
                                <td>{{ empty($asset->partOf()->first()->name) ? "-" : $asset->partOf()->first()->name }}</td>
                                <td>{{ @$asset->city()->first()->name }}</td>
                                <td>{{ date('d M Y', strtotime($asset->dop)) }}</td>
                                <td>{{ $asset->is_active == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ @$asset->addedBy()->first()->first_name }}</td>

                                <td>
                                    <a href="{{ route('admin.assets.show',['id' => $asset->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">View</a>
                                    <a href="{{ route('admin.assets.edit',['id' => $asset->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>                                
                                    <a href="{{ route('admin.assets.delete',['id' => $asset->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $assets->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 