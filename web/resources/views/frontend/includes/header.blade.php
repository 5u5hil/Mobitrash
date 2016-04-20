<!-- Header
                ============================================= -->
<header id="header" class="sticky-style-2">

    <div class="container clearfix">

        <!-- Logo
        ============================================= -->
        <div id="logo">
            <a href="{{ route('/') }}" class="standard-logo" data-dark-logo="/public/images/moblogo.png"><img src="{{ asset('public/Frontend/images/moblogo.png')}}" alt="Canvas Logo"></a>
            <a href="{{ route('/') }}" class="retina-logo" data-dark-logo="public/images/moblogo.png"><img src="{{ asset('public/Frontend/images/moblogo@2x.png')}}" alt="Canvas Logo"></a>
        </div><!-- #logo end -->

        <ul class="header-extras">
            <li>
                <i class="i-small i-circled i-bordered fa fa-phone nomargin"></i>
                <div class="he-text">
                    +91 9158285796
                </div>
            </li>
            <li>
                <i class="i-small i-circled i-bordered fa fa-envelope nomargin"></i>
                <div class="he-text">
                    getit@mobitrash.in 
                </div>
            </li>
        </ul>

    </div>

    <div id="header-wrap">

        <!-- Primary Navigation
        ============================================= -->
        <nav id="primary-menu" class="style-2">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <ul>
                    <li class="{{ preg_match("/\//",Route::currentRouteName())? 'current' : ''}}"><a href="#"><div>Home</div></a>
                    </li>
                    <!-- Mega Menu
                    ============================================= -->
                    <li class="{{ preg_match("/about/",Route::currentRouteName())? 'current' : ''}}"><a href="#"><div>About</div></a>
                    </li><!-- .mega-menu end -->
                    <li class="{{ preg_match("/pricing/",Route::currentRouteName())? 'current' : ''}}"><a href="#"><div>Pricing</div></a>
                    </li><!-- .mega-menu end -->
                    <li><a href="#"><div>Contact</div></a></li>
                    @if(Auth::id())
                    <li class="{{ preg_match("/user.myprofile.view/",Route::currentRouteName()) || preg_match("/user.subscription.view/",Route::currentRouteName()) || preg_match("/user.myaccount.view/",Route::currentRouteName()) ? 'current' : ''}}"><a href="{{ route('user.myprofile.view') }}"><div>Profile</div></a></li>
                    <li><a href="{{ route('user.logout') }}"><div>Logout</div></a></li>
                    @else
                    <li class="{{ preg_match("/user.login/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('user.login') }}"><div>Login</div></a></li>
                    @endif
                </ul>

                <!-- Top Search
                ============================================= -->
                <div id="top-search">
                    <a href="#"><i class="icon-facebook"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->
                <div id="top-search" class="hidden-xs hidden-sm">
                    <a href="#"><i class="icon-twitter"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->
                <div id="top-search" class="hidden-xs hidden-sm">
                    <a href="#"><i class="icon-youtube"></i><i class="icon-line-cross"></i></a>

                </div><!-- #top-search end -->

            </div>

        </nav><!-- #primary-menu end -->

    </div>

</header>
<!-- #header end -->