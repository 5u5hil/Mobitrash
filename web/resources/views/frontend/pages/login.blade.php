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
                                    <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('user.check.login') }}" method="post">
                                        <h3>Login to your Account</h3>

                                        <div class="col_full">
                                            <label for="email">Email Id:</label>
                                            <input type="text" id="email" name="email" value="" class="sm-form-control" />
                                        </div>

                                        <div class="col_full">
                                            <label for="password">Password:</label>
                                            <input type="text" id="password" name="password" value="" class="sm-form-control" />
                                        </div>

                                        <div class="col_full nobottommargin">
                                            <button type="submit" class="button button-3d button-black nomargin" id="login-form-submit">Login</button>
                                            <a href="{{route('user.forgot.password')}}" class="fright">Forgot Password?</a>
                                        </div>
                                    </form>

                                    <div class="line line-sm"></div>

                                    <div class="center">
                                        <h4 style="margin-bottom: 15px;">or Login with:</h4>
                                        <a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
                                    </div>
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