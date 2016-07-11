@extends('frontend.layouts.site')
@section('content')

    <div class="bannersec">
        <div class="bannersec2">
            <p>Lets <span>Mobitrash</span> it!</p>
            <p>Before the garbage piles around eat us alive, let us together turn it,into 'green'!
                Introducing MOBITRASH,
                India's first comprehensive mobile organic waste collection and treatment solution 
                <br><br><?php if (!Auth::id()): ?>
                <span>Join Today & Inspire Others!</span> 
                <div>
               
                <div class="text-center butttop">
                 <a href="{{ route('user.contact.view') }}" class="button button-large resbutt1 resbutt2 resbutt1-border resbutt1-large button-border button-rounded bannerbutt">Sign Up Now!</a>   
                </div> 
   <?php endif; ?>
                <div class="counter counters1"><span data-from="0" data-to="{{ @$waste_till_date_sum }}" data-refresh-interval="50" data-speed="2000">{{ @$waste_till_date_sum }}</span>kg</div>
                <h6 class="counters2">Waste Treated So Far</h6>
                </div>
                
            </p>   
        </div>
 

    <!-- <div class="preloadhiddenimb" style="display:none; position:absolute; left:-9999999; top:-999999; opacity:0;">
    <img src="public/Frontend/images/bannerimg/1.jpg"><img src="public/Frontend/images/bannerimg/2.jpg"><img src="public/Frontend/images/bannerimg/3.jpg"><img src="public/Frontend/images/bannerimg/4.jpg"><img src="public/Frontend/images/bannerimg/5.jpg"><img src="public/Frontend/images/bannerimg/6.jpg"><img src="public/Frontend/images/bannerimg/7.jpg"><img src="public/Frontend/images/bannerimg/8.jpg"><img src="public/Frontend/images/bannerimg/9.jpg"><img src="public/Frontend/images/bannerimg/10.jpg"><img src="public/Frontend/images/bannerimg/11.jpg"><img src="public/Frontend/images/bannerimg/12.jpg"><img src="public/Frontend/images/bannerimg/13.jpg"><img src="public/Frontend/images/bannerimg/14.jpg"><img src="public/Frontend/images/bannerimg/15.jpg"><img src="public/Frontend/images/bannerimg/16.jpg"><img src="public/Frontend/images/bannerimg/17.jpg"><img src="public/Frontend/images/bannerimg/18.jpg"><img src="public/Frontend/images/bannerimg/19.jpg"><img src="public/Frontend/images/bannerimg/20.jpg"><img src="public/Frontend/images/bannerimg/21.jpg"><img src="public/Frontend/images/bannerimg/22.jpg"><img src="public/Frontend/images/bannerimg/23.jpg"><img src="public/Frontend/images/bannerimg/24.jpg"><img src="public/Frontend/images/bannerimg/25.jpg"><img src="public/Frontend/images/bannerimg/26.jpg"><img src="public/Frontend/images/bannerimg/27.jpg"><img src="public/Frontend/images/bannerimg/28.jpg"><img src="public/Frontend/images/bannerimg/29.jpg"><img src="public/Frontend/images/bannerimg/30.jpg"><img src="public/Frontend/images/bannerimg/31.jpg"><img src="public/Frontend/images/bannerimg/32.jpg"><img src="public/Frontend/images/bannerimg/33.jpg"><img src="public/Frontend/images/bannerimg/34.jpg"><img src="public/Frontend/images/bannerimg/35.jpg"><img src="public/Frontend/images/bannerimg/36.jpg"><img src="public/Frontend/images/bannerimg/37.jpg"></div> -->

</div>

           <!--  <img id="img" src="1.jpg"/> -->
<img src="{{ asset('public/Frontend/images/Single-image-for-homepage-banner.jpg')}}" class="img-responsive">
</div>


<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <!-- <div class="col_one_third bottommargin-sm center">
                <img data-animate="fadeInLeft" src="{{ asset('public/Frontend/images/bulb.png')}}" alt="Iphone">
            </div> -->
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="center fruittop">
                    <h1>What is MobiTrash?</h1>
                </div>
                <p class="texts">MobiTrash is a mobile van waste treatment service which treats your segregated organic waste from your own site. MobiTrash provides primary treatment to segregated organic waste and turns it into odour free raw compost, which is carted away for further curing.</p>
                <center>
                    <a href="{{ route('user.about') }}" class="button button-3d button-rounded button-green">Read More</a>
                </center>
            </div>

        </div>
</section>       
<div class="section bottommargin">
    <div class="container clearfix">
        <div class="row topmargin-sm">
            <div class="col-md-4 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-pagelines"></i>
                        </div>

                        <h3 class="mobiupper">Green<span class="subtitle">Make Your Waste Green</span></h3>
                        <p>Make your waste green! We collect your segregated organic waste and composts it on-the-go.</p>
                    </div> 

                </div> 

            </div>

            <div class="col-md-4 col-sm-6 bottommargin">
                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i><img src="{{ asset('public/Frontend/images/Smart_icon.png')}}" alt="Mobitrash"></i>
                        </div>
                        <h3 class="mobiupper">Smart<span class="subtitle">Be A Smart Citizen</span></h3>
                        <p>Become a smart citizen of a smart city and inspire your next generation to live in a cleaner surrounding.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i><img src="{{ asset('public/Frontend/images/Swachh_icon.png')}}" alt="Mobitrash"></i>
                        </div>
                        <h3 class="mobiupper">Swachh<span class="subtitle">Make Our Country Swachh</span></h3>
                        <p>Together, lets make India 'swachh'. Start from your house and spread the message across.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<div class="clear"></div>
<section id="content">
    <div class="container clearfix">
        <div class="center fruittop">
            <h1>Treat your Waste. Professionally!</h1>
        </div>
        <div class="row topmargin-sm">

            <div class="col-xs treatwidth hidden-sm hidden-col-md-15 hidden-col-sm-15 hidden-col-xs-15 bottommargin clearfix"></div>
            <div class="col-md-2 col-sm-6 bottommargin">
                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="treatimg">
                            <img src="{{ asset('public/Frontend/images/sign_up.png')}}" alt="John Doe">
                        </div>

                        <h3 class="mobiupper">SIGN UP</h3>
                        <p>Sign up to fix a meeting & further start a free trial. </p>
                    </div>  
                </div> 

            </div>

            <div class="col-md-2 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="treatimg">
                            <img src="{{ asset('public/Frontend/images/subscribe.png')}}" alt="Mobitrash">
                        </div>

                        <h3 class="mobiupper">SUBSCRIBE</h3>
                        <p>After the free trial, get registered by remitting a fee of INR 199 per household per month.</p>
                    </div>  
                </div>
            </div>

            <div class="col-md-2 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="treatimg">
                            <img src="{{ asset('public/Frontend/images/segregate.png')}}" alt="Mobitrash">
                        </div>

                        <h3 class="mobiupper">SEGREGATE</h3>
                        <p>Segregate wet waste from dry and other mixed waste.</p>
                    </div>  
                </div>
            </div>

            <div class="col-md-2 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="treatimg">
                            <img src="{{ asset('public/Frontend/images/handover.png')}}" alt="Mobitrash">
                        </div>

                        <h3 class="mobiupper">HANDOVER</h3>
                        <p>A MobiTrash van will come to your premises everyday to collect your wet waste & treat it within 20 minutes from your site.</p>
                    </div>  
                </div>
            </div>

            <div class="col-md-2 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="treatimg">
                            <img src="{{ asset('public/Frontend/images/We-Compost_icon.png')}}" alt="Mobitrash">
                        </div>

                        <h3 class="mobiupper">WE COMPOST</h3>
                        <p>The MobiTrash van would cart away for further composting.</p>
                    </div>  
                </div>
            </div>

        </div>

    </div>
</section>
<div class="clear"></div>

<!-- <a href="#" class="button button-full button-dark center tright">

    <div class="container clearfix bottommargin">
        <h1 style="color:#fff;">Treat Your Waste Professionally</h1>
    </div>
</a> -->
<!-- <div class="section bottommargin" style="background-color: #87c540 !important;">
    <div class="container clearfix">
        <div class="row clearfix bottommargin-lg common-height">

            <div class="col-md-12 col-sm-12 dark center col-padding" style="background-color: 87c540 !important;">
                <div>

                    <i class="fa fa-trash-o" aria-hidden="true"></i>

                    <div class="counter counter-lined"><span data-from="0" data-to="{{ @$waste_till_date_sum }}" data-refresh-interval="50" data-speed="2000"></span>kg</div>
                    <h5>Waste Treated So Far</h5>
                </div>
            </div>

        </div>
    </div>
</div> -->
<div class="clear"></div>
<div class="section bottommargin">
    <div class="container clearfix">
        <div class="center fruittop">
            <h1>MobiTrash Treats</h1>
        </div>
        <div class="row topmargin-sm">

            <div class="col-xs hidden-col-md-15 hidden-sm hidden-col-sm-15 hidden-col-xs-15 bottommargin clearfix"></div>
            <div class="col-md-2 col-xs-11 col-sm-6 bottommargin">
                <div class="team">
                    <div class="team-image">
                        <img src="{{ asset('public/Frontend/images/fruit1.png')}}" alt="John Doe">
                    </div>
                    <div class="team-desc team-desc-bg">
                        <div class="team-title"><h5>Fruit and Vegetable Waste</h5></div>

                    </div>
                </div>

            </div>

            <div class="col-md-2 col-xs-11 col-sm-6 bottommargin">

                <div class="team">
                    <div class="team-image">
                        <img src="{{ asset('public/Frontend/images/fruit2.png')}}" alt="Mobitrash">
                    </div>
                    <div class="team-desc team-desc-bg">
                        <div class="team-title"><h5>Cooked Food Waste</h5></div>

                    </div>
                </div>

            </div>

            <div class="col-md-2 col-xs-11 col-sm-6 bottommargin">

                <div class="team">
                    <div class="team-image">
                        <img src="{{ asset('public/Frontend/images/fruit3.png')}}" alt="Mobitrash">
                    </div>
                    <div class="team-desc team-desc-bg">
                        <div class="team-title"><h5>Non-Vegetarian Waste</h5></div>

                    </div>
                </div>

            </div>

            <div class="col-md-2 col-xs-11 col-sm-6 bottommargin">

                <div class="team">
                    <div class="team-image">
                        <img src="{{ asset('public/Frontend/images/fruit4.png')}}" alt="Mobitrash">
                    </div>
                    <div class="team-desc team-desc-bg">
                        <div class="team-title"><h5>Processed Food Waste</h5></div>

                    </div>
                </div>

            </div>

            <div class="col-md-2 col-xs-11 col-sm-6 bottommargin">
                <div class="team">
                    <div class="team-image">
                        <img src="{{ asset('public/Frontend/images/fruit5.png')}}" alt="Mobitrash">
                    </div>
                    <div class="team-desc team-desc-bg">
                        <div class="team-title"><h5>Garden Waste</h5></div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<div class="bottommargin">
    <div class="container clearfix">
        <div class="center fruittop">
            <h1>We cater to</h1>
        </div>
        <div class="row topmargin-sm">
            <div class="col-md-3 col-sm-6 bottommargin">
                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i><img src="{{ asset('public/Frontend/images/residency_icon.png')}}" alt="Mobitrash"></i>
                        </div>
                        <span class="subtitle">Residential Buildings</span>
                    </div> 

                </div> 

            </div>

            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-building" aria-hidden="true"></i>
                        </div>
                        <span class="subtitle">Corporate Offices</span>
                    </div>
                </div>

            </div>

            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-cutlery" aria-hidden="true"></i>
                        </div>
                        <span class="subtitle">Restaurants & Hotels</span>
                    </div>
                </div>

            </div>
            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i><img src="{{ asset('public/Frontend/images/commercial.png')}}" alt="Mobitrash"></i>
                        </div>
                        <span class="subtitle">Commercial Complexes</span>
                    </div>
                </div>

            </div>
            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i><img src="{{ asset('public/Frontend/images/education.png')}}" alt="Mobitrash"></i>
                        </div>
                        <span class="subtitle">Educational Institutes</span>
                    </div>
                </div>

            </div>

            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-hospital-o" aria-hidden="true"></i>
                        </div>
                        <span class="subtitle">Hospital Canteens</span>

                    </div>
                </div>

            </div>

            <div class="col-md-3 col-sm-6 bottommargin">

                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-industry" aria-hidden="true"></i>
                        </div>
                        <span class="subtitle">Factories / Industries</span>

                    </div>
                </div>

            </div>
            <div class="col-md-3 col-sm-6 bottommargin">
                <div class="team">
                    <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
                        <div class="fbox-icon">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </div>
                        <span class="subtitle">Any Bulk Waste Generator</span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<div class="clear"></div>
<?php if (!Auth::id()): ?>
    <div class="section parallax dark " style="background-image: url('{{ asset('public/Frontend/images/services/home-testi-bg.jpg')}}');" data-stellar-background-ratio="0.4">
        <div class="center">
            <h1  class="fadeInUp animated">Start MobiTrashing Now</h1>
            <h4>Join Today & Inspire Others!</h4>

            <div class="team-desc">
                <img src="{{ asset('public/Frontend/images/mobgreen.png')}}"/>
            </div>
            <a href="{{ route('user.contact.view') }}" class="button button-rounded  button-large button-border"><span>Get Started</span></a>
        </div>

    </div>
<?php endif; ?>
<div class="clear"></div>
</div>
</div>
@stop