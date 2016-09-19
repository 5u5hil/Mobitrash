<!-- Header
        ============================================= -->
<header id="header" class="transparent-header full-header">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div class="logoalign" id="logo">
                <a href="{{ route('/') }}" class="standard-logo" data-dark-logo="/public/images/mobgreen.png"><img src="{{ asset('public/Frontend/images/mobgreen.png')}}" alt="Mobitrash"></a>
                <a href="{{ route('/') }}" class="retina-logo" data-dark-logo="public/images/moblogo.png"><img src="{{ asset('public/Frontend/images/mobgreen.png')}}" alt="Mobitrash"></a>
            </div><!-- #logo end -->

            <!-- Primary Navigation
        ============================================= -->
            <nav id="primary-menu" class="dark">

                <ul class="socialborder">
                    <li class="{{ preg_match("/\//",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('/') }}"><div>Home</div></a>
                    </li>
                    <li class="{{ preg_match("/about/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('user.about') }}"><div>About</div></a>
                    </li>
                    <li class="{{ preg_match("/user.faq/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('user.faq') }}"><div>FAQ</div></a>
                    </li>
<!--                    <li class="{{ preg_match("/pricing/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('/') }}"><div>Pricing</div></a>
                    </li>-->
                    <li class="{{ preg_match("/user.contact.view/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('user.contact.view') }}"><div>Contact</div></a>
                    </li>
                    @if(Auth::id())
                    <li class="{{ preg_match("/user.myprofile.view/",Route::currentRouteName()) || preg_match("/user.subscription.view/",Route::currentRouteName()) || preg_match("/user.myaccount.view/",Route::currentRouteName()) ? 'current' : ''}}"><a href="{{ route('user.myprofile.view') }}"><div>Profile</div></a></li>
                    <li><a href="{{ route('user.logout') }}"><div>Logout</div></a></li>
                    @else
                    <li class="{{ preg_match("/user.login/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('user.login') }}"><div>Login</div></a></li>
                    @endif 
                    <li class="{{ preg_match("/garden.waste/",Route::currentRouteName())? 'current' : ''}}"><a href="{{ route('garden.waste') }}" style="padding: 10px 0px;"><div style="padding: 8px;border-radius: 4px;color: #fff; background: #87C540;">Pick my Garden Waste</div></a>
                    </li>
                </ul>

                <!-- Top Search
                ============================================= -->
                <div id="top-search" class="socialyset">
                    <a href="https://m.youtube.com/channel/UCiH6PGG2frydhLmDyl5e7Aw" target="_BLANK" ><i class="fa fa-youtube-play fa-lg"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->
                <div id="top-search" class="socialtset">
                    <a href="https://mobile.twitter.com/mobitrashIN" target="_BLANK" ><i class="fa fa-twitter fa-lg"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->
                 <div id="top-search" class="socialfset">
                    <a href="https://m.facebook.com/MobiTrashIndia/?fref=ts" target="_BLANK" ><i class="fa fa-facebook fa-lg"></i><i class="icon-line-cross"></i></a>
                </div><!-- #top-search end -->
            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header><!-- #header end -->
