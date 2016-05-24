@extends('frontend.layouts.site')
@section('content')

<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="250px" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle">

                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>Login</span>
                        </div>
                    </h1>
                    <p>Login To Your MobiTrash Account</p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap nopadding">

        <div class="section nopadding nomargin loginback" style="background: url('{{asset('public/Frontend/images/parallax/home/1.jpg')}}') center center no-repeat;"></div>

        <div class="section nobg full-screen nopadding nomargin">
            <div class="container vertical-middle divcenter clearfix">

                <div class="row center">
                    <a href="{{route('/')}}"><img src="{{asset('public/Frontend/images/loginlogo.png')}}" alt="Mobitrash"></a>
                </div>

                <div class="panel panel-default divcenter noradius noborder loginpan">
                    <div class="panel-body" style="padding: 40px;">                                    
                        <div class="flash-message red">
                            {{@Session::pull('invalidUser')}}                            
                        </div>
                        <div class="flash-message green">
                            {{@Session::pull('PasswordSuccess')}}                            
                        </div>
                        <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('user.check.login') }}" method="post" style="margin-top: 15px;">
                            <h3>Login to your Account</h3>

                            <div class="col_full">
                                <label for="email">Email Id:</label>
                                <input type="text" id="email" name="email" value="" class="sm-form-control" />
                            </div>

                            <div class="col_full">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" value="" class="sm-form-control" />
                            </div>

                            <div class="col_full nobottommargin">
                                <button type="submit" class="button button-3d button-black nomargin" id="login-form-submit">Login</button>
                                <a href="{{route('user.forgot.password')}}" class="fright">Forgot Password?</a>
                            </div>
                        </form>

                    </div> 
                </div>

            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop
<!-- External JavaScripts
============================================= -->
