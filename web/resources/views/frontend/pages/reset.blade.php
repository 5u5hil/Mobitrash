<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        @include('frontend.includes.head')
        @yield('mystyles')
    </head>

    <body class="stretched">

        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">

            <!-- Content
            ============================================= -->
            <section id="content">

                <div class="content-wrap nopadding">

                    <div class="section nopadding nomargin loginsec" style="background: url('{{ asset('public/Frontend/images/parallax/home/1.jpg')}}') center center no-repeat;"></div>

                    <div class="section nobg full-screen nopadding nomargin">
                        <div class="container vertical-middle divcenter clearfix">

                            <div class="row center"> 
                                <a href="{{ route('/') }}"><img src="{{ asset('public/Frontend/images/loginlogo.png')}}" alt="Mobitrash"></a>
                            </div>

                            <div class="panel panel-default divcenter noradius noborder loginpanel">
                                <div class="panel-body" style="padding: 40px;">                                    
                                    <div class="flash-message red">
                                        {{Session::pull('invalidUser')}}                            
                                    </div>
                                    @if($user)
                                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('user.password.update') }}" method="post"  style="margin-top: 15px;">
                                        <h3>Reset Password</h3>

                                        <div class="col_full">
                                            <label for="password">New Password:</label>
                                            <input type="text" id="password" name="new_password" value="" class="sm-form-control validate[required]" />
                                        </div>

                                        <div class="col_full">
                                            <label for="confirm-password">Confirm Password:</label>
                                            <input type="text" id="confirm-password" name="confirm_password" value="" class="sm-form-control validate[equals[password]]" />
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

                            <div class="row center dark"><small>Copyrights &copy; All Rights Reserved.</small></div>

                        </div>
                    </div>

                </div>

            </section><!-- #content end -->

        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>

        <!-- External JavaScripts
        ============================================= -->
        @include('frontend.includes.foot')

    </body>
</html>