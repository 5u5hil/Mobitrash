@extends('frontend.layouts.site')
@section('content')

<!-- Content
                ============================================= -->

<section id="page-title">

    <div class="container clearfix">
        <h1>My Profile</h1>
        <div class="flash-message green">
            {{Session::pull('profileSuccess')}}  
            {{Session::pull('PasswordSuccess')}}  
        </div>
        <div class="flash-message red">
            {{Session::pull('PasswordError')}}                            
        </div>

    </div>

</section><!-- #page-title end -->

<section id="content">
    <div class="content-wrap">

        <div class="container clearfix">
            <div class="sidebar nobottommargin">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <div class="fancy-title title-bottom-border">
                            <h4>{{$user->first_name. ' '. $user->last_name}}</h4>
                        </div>
                        <div id="headsub">
                            <ul class="icons iconlist-large iconlist-color">
                                <li><a href="{{route('user.myaccount.view')}}">Service Summary</a></li>
                                <li><a href="{{route('user.subscription.view')}}">My Subscriptions</a></li>
                                <li class="actives"><a href="{{route('user.myprofile.view')}}">My Profile</a></li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

            <div class="postcontent col_last nobottommargin">

                <!-- Portfolio Single Image
                ============================================= -->
                <div class="col_full portfolio-single-image">
                    <div class="fancy-title title-bottom-border">
                        <h4>My Profile</h4>
                    </div>
                    <div class="">  
                        {!! Form::model($user, ['method' => 'post', 'route' => $action , 'class' => 'nobottommargin' ]) !!}
                        <div class="form-process"></div>
                        <div class="col_one_third">
                            <label for="firstname">First Name:</label><small>*</small>
                            {!! Form::text('first_name',null, ["class"=>"sm-form-control validate[required]" ,"placeholder"=>"First Name"]) !!}
                        </div>
                        <div class="col_one_third">
                            <label for="lastname">Last Name:</label>
                            {!! Form::text('last_name',null, ["class"=>"sm-form-control" ,"placeholder"=>"Last Name"]) !!}
                        </div>
                        <div class="col_one_third">
                            <label for="phone-number">Phone No:</label><small>*</small>
                            {!! Form::text('phone_number',null, ["class"=>"sm-form-control validate[required,custom[number]]" ,"placeholder"=>""]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="email">Email Id:</label><small>*</small>
                            {!! Form::text('email',null, ["class"=>"sm-form-control validate[required,custom[email]]" ,"placeholder"=>"Phone No"]) !!}
                        </div>

                        <div class="clear"></div>

                        <div class="col_one_third">
                            <label for="old-password">Old Password:</label>
                            {!! Form::text('old_password',null, ["class"=>"sm-form-control " ,"placeholder"=>"Old Password"]) !!}
                        </div>


                        <div class="col_one_third">
                            <label for="password">New Password:</label>
                            {!! Form::text('new_password',null, ["class"=>"sm-form-control " ,"placeholder"=>"New Password"]) !!}
                        </div>

                        <div class="col_one_third col_last">
                            <label for="confirm-password">Reenter New Password:</label>
                            {!! Form::text('confirm_password',null, ["class"=>"sm-form-control" ,"placeholder"=>"Reenter New Password"]) !!}
                        </div>

                        <div class="clear"></div>

                        <center>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="button button-3d button-black nomargin">Submit</button>
                            </div>
                        </center>
                        {!! Form::hidden('id',null) !!}
                        {!! Form::close() !!}  

                    </div>
                </div><!-- .portfolio-single-image end -->
                <div class="clear"></div>
            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop