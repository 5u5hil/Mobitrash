@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Record
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.record.view') }}"><i class="fa fa-coffee"></i>Record</a></li>
        <li class="active">view</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered view-table">
                        <tbody>
                            <tr>
                                <td>Record Type</td>
                                <td>
                                    {{@$record->rtype->name}}
                                </td>
                            </tr>                            
                            <tr>
                                <td>Asset</td>
                                <td>
                                    {{@$record->asset->name .' - '. @$record->asset->asset_no}}
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>
                                    {{ @date("d M Y",strtotime(@$record->date)) }}
                                </td>
                            </tr>
                            @if($record->recordtype_id != 3)  
                            <tr>
                                <td>Remarks</td>
                                <td>
                                    {{$record->remarks}}
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>
                                    {{$record->amt}}
                                </td>
                            </tr>
                            @if($record->recordtype_id == 1)                            
                            <tr>
                                <td>Fuel Type</td>
                                <td>
                                    {{@$record->fueltypes->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>
                                    {{$record->quantity}}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>Attachments</td>
                                <td>
                                    @foreach($atts as $key => $att)

                                    <div class="row form-group">
                                        <div class="col-sm-2">
                                            <a href="{{ Config('constants.uploadRecord').$att->file }}" target="_blank">{{ $att->filename }}</a>
                                            
                                        </div>                                        
                                    </div>
                                    @endforeach
                                </td>
                            </tr>
                            @endif
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