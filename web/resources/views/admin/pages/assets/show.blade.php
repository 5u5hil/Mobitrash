@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Assets
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.assets.view') }}"><i class="fa fa-coffee"></i>Assets</a></li>
        <li class="active">view</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><b>{{$assets->name}}</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered view-table">
                        <tbody>
                            <tr>
                                <td>Asset Type</td>
                                <td>
                                    {{$assets->type->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Asset Number</td>
                                <td>
                                    {{@$assets->asset_no}}
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    {{@$assets->city->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Part Of</td>
                                <td>
                                    <?php if(@$assets->partof->name){ echo $assets->partOf->name;}else{ echo 'Individual Asset'; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>DOP</td>
                                <td>
                                    {{date('d M Y', strtotime(@$asset->dop))}}
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>


@stop 

@section('myscripts')

<script>



</script>

@stop