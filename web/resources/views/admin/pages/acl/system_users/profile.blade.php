@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
</section>

<section class="content">


    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#edit-profile" data-toggle="tab" aria-expanded="true">Edit Profile</a></li>
            <li class=""><a href="#change-password" data-toggle="tab" aria-expanded="true">Change Password</a></li>

        </ul>
        <div  class="tab-content" >
            <div class="tab-pane active" id="edit-profile">
                <p style="color:green;text-align: center;">{{ Session::get('profileSuccess') }}</p>
                <p style="color:red;text-align: center;">{{ Session::get('ProfileError') }}</p>

                {!! Form::model($user, ['method' => 'post', 'route' => $action , 'class' => 'form-horizontal', 'files'=>true ]) !!}
                <div class="form-group">
                    {!!Form::label('Name','Name',['class'=>'col-sm-2 control-label required']) !!}
                    {!! Form::hidden('id',null) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name',null, ["class"=>'form-control' ,"placeholder"=>'Name', "required"]) !!}
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    {!!Form::label('Phone','Phone Number',['class'=>'col-sm-2 control-label required']) !!}
                    <div class="col-sm-10">
                        {!! Form::tel('phone_number',null, ["class"=>'form-control' ,"placeholder"=>'Phone Number', "required"]) !!}
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group">
                    {!!Form::label('Email','Email',['class'=>'col-sm-2 control-label required']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email',null, ["class"=>'form-control' ,"placeholder"=>'Email', "required"]) !!}
                    </div>
                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    {!!Form::label('Profile Picture','Profile Picture',['class'=>'col-sm-2 control-label optional']) !!}
                    <div class="col-sm-10">
                        {!! Form::file('profile_picture', ["class"=>'form-control' ,"placeholder"=>'Profile Picture']) !!}
                    </div>
                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        {!! Form::submit('Submit',["class" => "btn btn-primary SustemUserSubmit"]) !!}

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="change-password">
                <p style="color:green;text-align: center;">{{ Session::get('profileSuccess') }}</p>
                <p style="color:red;text-align: center;">{{ Session::get('ProfileError') }}</p>
                {!! Form::model($user, ['method' => 'post', 'route' => 'admin.systemusers.update.password' , 'class' => 'form-horizontal', 'files'=>true ]) !!}
                {!! Form::hidden('id',null) !!}
                <div class="form-group">
                    {!!Form::label('Password','Old Password',['class'=>'col-sm-2 control-label required']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('old_password', ["class"=>'form-control' ,"placeholder"=>'Old Password', "required"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('Password','New Password',['class'=>'col-sm-2 control-label required ']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('new_password', ["class"=>'form-control' ,"placeholder"=>'New Password', "required"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('Password','Conform Password',['class'=>'col-sm-2 control-label required']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('confirm_password', ["class"=>'form-control' ,"placeholder"=>'Conform Password', "required"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        {!! Form::submit('Submit',["class" => "btn btn-primary SustemUserSubmit"]) !!}

                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>


</div>
</section>
@stop


@section("myscripts")
<script>
    //$(document).ready(function(){
    @if(Input::get('tab'))
        $("#{{Input::get('tab')}}").tab('show');
    @endif
    
   // });
</script>


@stop