@extends('admin.layouts.default')
@section('content')

<section class="content-header">
    <h1>
      Add New Role
        <small>Add/Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.roles.view') }}"><i class="fa fa-coffee"></i>Roles</a></li>
        <li class="active">Add/Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

        {!! Form::model($role, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal' ]) !!}
        <div class="form-group">
            {!!Form::label('Role','Role',['class'=>'col-sm-2 ']) !!}
            <div class="col-sm-10">
                {!! Form::text('display_name',null, ["class"=>'form-control' ,"placeholder"=>'Role Display Name', "required"]) !!}
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            {!!Form::label('Unique Identifier','Unique Identifier',['class'=>'col-sm-2 ']) !!}
            <div class="col-sm-10">
                {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'Unique Identifier']) !!}
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            {!!Form::label('Description','Description',['class'=>'col-sm-2 ']) !!}
            <div class="col-sm-10">
                {!! Form::text('description',null, ["class"=>'form-control' ,"placeholder"=>'Description']) !!}
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            {!!Form::label('Allocate Permissions','Allocate Permissions',['class'=>'col-sm-2 ']) !!}
            <div class="col-sm-10">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <label for="perm" class=""><input type="checkbox"  id="perm" name="chkAll"> Grant Complete Access</label>
                </div>
                @foreach($permissions as $perm)
                
                <div class="col-sm-3 col-xs-3 col-md-3">
                    <label for="perm{{ $perm->id }}" class=""><input type="checkbox" {{ in_array($perm->id, array_flatten($role->perms()->get(['id'])->toArray())) ? 'checked' : ''  }}  value="{{ $perm->id }}" id="perm{{ $perm->id }}" name="chk[]"> {{ $perm->display_name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                {!! Form::hidden('id',null) !!}
                {!! Form::submit('Submit',["class" => "btn btn-primary"]) !!}
            </div>
        </div>
        {!! Form::close() !!}  
    </div>
</div>
</div>
</div>
</section>

@stop 

@section('myscripts')

<script>
   
        $("[name='chkAll']").click(function (event) {
            var checkbox = $(this);
            var isChecked = checkbox.is(':checked');
            if (isChecked) {
                $("[name='chk[]']").attr('Checked', 'Checked');
            } else {
                $("[name='chk[]']").removeAttr('Checked');
            }
        });
  
</script>

@stop