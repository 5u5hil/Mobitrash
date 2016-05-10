@extends('frontend.layouts.site')
@section('content')
 <section id="slider" class="slider-parallax" style="background-size: cover;background-color:#6e9d35" data-height-lg="500" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
            <div class="slider-parallax-inner">
                <div class="container clearfix">
                    <div class="vertical-middle">

                        <div class="heading-block nobottomborder">
                            <h1>
                                <div>
                                 <span>Banner Will Go Here</span>
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

    <div class="content-wrap">
        <div class="container clearfix">
            <!-- <div class="col_one_third bottommargin-sm center">
                <img data-animate="fadeInLeft" src="{{ asset('public/Frontend/images/bulb.png')}}" alt="Iphone">
            </div> -->
            <div class="col-md-12 col-xs-12 col-sm-12">
               <div class="center fruittop">
                    <h1>What is MobiTrash?</h1>
                </div>
                <p>MobiTrash is a mobile van waste treatment service which treats your segregated organic waste from your own site. MobiTrash provides primary treatment to segregated organic waste and turns it into odour free raw compost, which is carted away for further curing.</p>
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
								<a href="#"><i class="fa fa-pagelines"></i></a>
							</div>

							<h3>Green<span class="subtitle">Make Your Waste Green</span></h3>
							<p>Make your waste green! We collect your segregated organic waste and composts it on-the-go.</p>
						</div> 
                           
                        </div> 

                    </div>

                    <div class="col-md-4 col-sm-6 bottommargin">
                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i><img src="{{ asset('public/Frontend/images/Smart_icon.png')}}" alt="Mobitrash"></i></a>
							</div>
							<h3>Smart<span class="subtitle">Be A Smart Citizen</span></h3>
							<p>Become a smart citizen of a smart city and inspire your next generation to live in a cleaner surrounding.</p>
						</div>
                        </div>

                    </div>

                    <div class="col-md-4 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i><img src="{{ asset('public/Frontend/images/Swachh_icon.png')}}" alt="Mobitrash"></i></a>
							</div>
							<h3>Swachh<span class="subtitle">Make Our Country Swachh</span></h3>
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

                    <div class="col-xs hidden-col-md-15 hidden-col-sm-15 hidden-col-xs-15 bottommargin clearfix"></div>
                    <div class="col-md-2 col-sm-6 bottommargin">
                     <div class="team">
                          <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="treatimg">
								<a href="#"><img src="{{ asset('public/Frontend/images/sign_up.png')}}" alt="John Doe"></a>
							</div>

							<h3>SIGN UP</h3>
							<p>Sign up to fix a meeting & further start a free trial. </p>
						</div>  
                        </div> 

                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                     <div class="team">
                          <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="treatimg">
								<a href="#"><img src="{{ asset('public/Frontend/images/subscribe.png')}}" alt="Mobitrash"></a>
							</div>

							<h3>SUBSCRIBE</h3>
							<p>After the free trial, get registered by remitting a fee of INR 199 per household per month.</p>
						</div>  
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                     <div class="team">
                          <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="treatimg">
								<a href="#"><img src="{{ asset('public/Frontend/images/segregate.png')}}" alt="Mobitrash"></a>
							</div>

							<h3>SEGREGATE</h3>
							<p>Segregate wet waste from dry and other mixed waste.</p>
						</div>  
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                    <div class="team">
                          <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="treatimg">
								<a href="#"><img src="{{ asset('public/Frontend/images/handover.png')}}" alt="Mobitrash"></a>
							</div>

							<h3>HANDOVER</h3>
							<p>A MobiTrash van will come to your premises everyday to collect your wet waste & treat it within 20 minutes from your site.</p>
						</div>  
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                     <div class="team">
                          <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="treatimg">
								<a href="#"><img src="{{ asset('public/Frontend/images/We-Compost_icon.png')}}" alt="Mobitrash"></a>
							</div>

							<h3>WE COMPOST</h3>
							<p>The MobiTrash van would cart away for further composting.</p>
						</div>  
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- <a href="#" class="button button-full button-dark center tright">

            <div class="container clearfix bottommargin">
                <h1 style="color:#fff;">Treat Your Waste Professionally</h1>
            </div>
        </a> -->
        <div class="section bottommargin">
            <div class="container clearfix">
                <div class="center fruittop">
                    <h1>MobiTrash Treats</h1>
                </div>
                <div class="row topmargin-sm">

                    <div class="col-xs hidden-col-md-15 hidden-col-sm-15 hidden-col-xs-15 bottommargin clearfix"></div>
                    <div class="col-md-2 col-sm-6 bottommargin">
                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/fruit1.png')}}" alt="John Doe">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><span>Fruit and vegetable waste</span></div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/fruit2.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><span>Cooked food waste</span></div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/fruit3.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><span>Non-vegetarian waste</span></div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/fruit4.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><span>Processed food waste</span></div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-6 bottommargin">
                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/fruit5.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><span>Garden waste</span></div>

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
								<a href="#"><i><img src="{{ asset('public/Frontend/images/residency_icon.png')}}" alt="Mobitrash"></i></a>
							</div>
							<h3>Residential Buildings</h3>
						</div> 
                           
                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i class="fa fa-building" aria-hidden="true"></i></a>
							</div>
							<h3>Corporate Offices</h3>
						</div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i class="fa fa-cutlery" aria-hidden="true"></i></a>
							</div>
							<h3>Restaurants & Hotels</h3>
						</div>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i><img src="{{ asset('public/Frontend/images/commercial.png')}}" alt="Mobitrash"></i></a>
							</div>
							<h3>Commercial Complexes</h3>
						</div>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i><img src="{{ asset('public/Frontend/images/education.png')}}" alt="Mobitrash"></i></a>
							</div>
							<h3>Educational Institutes</h3>
						</div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i></a>
							</div>
							<h3>Hospital Canteens</h3>
							
						</div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i class="fa fa-industry" aria-hidden="true"></i></a>
							</div>
							<h3>Factories / Industries</h3>
							
						</div>
                        </div>

                    </div>
                     <div class="col-md-3 col-sm-6 bottommargin">
                        <div class="team">
                            <div class="feature-box fbox-center fbox-outline fbox-effect nobottomborder">
							<div class="fbox-icon">
								<a href="#"><i class="fa fa-list" aria-hidden="true"></i></a>
							</div>
							<h3>MORE</h3>
						</div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="section parallax dark " style="background-image: url('{{ asset('public/Frontend/images/services/home-testi-bg.jpg')}}');" data-stellar-background-ratio="0.4">

            <div class="center">
                <h1  class="fadeInUp animated">Start Recycling Now</h1>
                <h4>Join Today & Inspire Others!</h4>

                <div class="team-desc">
                    <a href="#"><img src="{{ asset('public/Frontend/images/mobgreen.png')}}"/></a>
                </div>
                <a href="#" class="button button-rounded button-reveal button-large button-border tright"><span>Login / Register</span></a>
            </div>

        </div>

        <div class="clear"></div>
</div>
</div>
@stop