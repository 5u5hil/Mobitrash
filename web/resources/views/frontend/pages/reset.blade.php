@extends('frontend.layouts.site')
@section('content')

<section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle">

                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>Password Reset</span>
                        </div>
                    </h1>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap nopadding">

        <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: url('{{asset('public/Frontend/images/parallax/home/1.jpg')}}') center center no-repeat; background-size: cover;"></div>

        <div class="section nobg full-screen nopadding nomargin">
            <div class="container divcenter clearfix">

                <div class="row center">
                    <a href="{{ route('/') }}"><img src="{{asset('public/Frontend/images/loginlogo.png')}}" alt="Mobitrash"></a>
                </div>

                <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                    <div class="panel-body" style="padding: 40px;">                                    
                        <div class="flash-message red">
                            {{Session::pull('invalidUser')}}                            
                        </div>
                        @if($user)
                        <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('user.password.update') }}" method="post"  style="margin-top: 15px;">
                            <h3>Reset Password</h3>

                            <div class="col_full">
                                <label for="password">New Password:</label>
                                <input type="password" id="password" name="new_password" value="" class="sm-form-control validate[required]" />
                            </div>

                            <div class="col_full">
                                <label for="confirm-password">Confirm Password:</label>
                                <input type="password" id="confirm-password" name="confirm_password" value="" class="sm-form-control validate[equals[password]]" />
                            </div>

                            <div class="col_full nobottommargin">
                                <button type="submit" class="button button-3d button-black nomargin" id="login-form-submit">Reset</button>

                            </div>
                            <input type="hidden" name="var_code" value="{{ base64_encode($user->varification_code) }}"  />
                        </form>
                        @else
                        <div>Link Expired! Please try again.</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

</section><!-- #content end -->

@stop
<!-- External JavaScripts
============================================= -->
@include('frontend.includes.foot')





