@extends('frontend.layouts.site')
@section('content')
 <section id="slider" class="slider-parallax" style="background-size: cover;background-color:#6e9d35" data-height-lg="500" data-height-md="500" data-height-sm="400" data-height-xs="250" data-height-xxs="200">
            <div class="slider-parallax-inner">
                <div class="container clearfix">
                    <div class="vertical-middle">

                        <div class="heading-block nobottomborder">
                            <h1>
                                <div>
                                 <span>Home Page</span>
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

        <!-- <div class="section topmargin nobottommargin nobottomborder">
                <div class="container clearfix">
                        <div class="heading-block center nomargin">
                                <h3>Our Latest Works</h3>
                        </div>
                </div>
        </div> -->

        <div class="container clearfix">

            <div class="col_one_third bottommargin-sm center">
                <img data-animate="fadeInLeft" src="{{ asset('public/Frontend/images/bulb.png')}}" alt="Iphone">
            </div>

            <div class="col_two_third bottommargin-sm col_last">

                <div class="topmargin-sm">
                    <h3>Optimized for Mobile &amp; Touch Enabled Devices.</h3>
                </div>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quod consequuntur quibusdam, enim expedita sed quia nesciunt incidunt accusamus necessitatibus modi adipisci officia libero accusantium esse hic, obcaecati, ullam, laboriosam!</p>


                <p><strong> Join Today and Inspire Others!</strong></p>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti vero, animi suscipit id facere officia. Aspernatur, quo, quos nisi dolorum aperiam fugiat deserunt velit rerum laudantium cum magnam.</p>

            </div>

        </div>

        <div class="section">
            <div class="container clearfix">

                <div class="row topmargin-sm">

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/leaf5.png')}}" alt="John Doe">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><h4>Mobi Trash</h4><span>What Is It?</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/leaf1.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><h4>Green</h4><span>Make Your Waste Green</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/leafs2.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><h4>Smart</h4><span>Be A Smart Citizens</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 bottommargin">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('public/Frontend/images/leaf4.png')}}" alt="Mobitrash">
                            </div>
                            <div class="team-desc team-desc-bg">
                                <div class="team-title"><h4>Swachh</h4><span>Make Our Country Swachh</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="clear"></div>

        <a href="#" class="button button-full button-dark center tright">
            <div class="container clearfix bottommargin">
                <h1 style="color:#fff;">Treat Your Waste Professionally</h1> <span>Five steps goes right below the heading</span>
            </div>
        </a>



        <div class="section">
            <div class="container clearfix">
                <div class="center fruittop">
                    <span>What Can Be Treated In</span>
                    <h1>MobiTrash</h1>
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
        <div class="section parallax dark bottommargin" style="background-image: url('{{ asset('public/Frontend/images/services/home-testi-bg.jpg')}}'); padding: 100px 0;" data-stellar-background-ratio="0.4">

            <div class="center">
                <h1  class="fadeInUp animated">Start Recycling Now</h1>
                <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </h4>

                <div class="team-desc">
                    <a href="#"><img src="{{ asset('public/Frontend/images/mobgreen.png')}}"/></a>
                </div>
                <a href="#" class="button button-rounded button-reveal button-large button-border tright"><span>Login / Register</span></a>
            </div>

        </div>

        <div class="container bottommargin clearfix">
            <div class="row">
                <div class="center">
                    <span>We Are Happy To Answers Your Questions</span>
                    <h1>FAQS</h1>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">

                    <div class="accordion accordion-border clearfix" data-state="closed">

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-comments-alt"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, placeat, architecto rem dolorem dignissimos repellat veritatis in et eos doloribus magnam aliquam ipsa alias assumenda officiis quasi sapiente suscipit veniam odio voluptatum. Enim at asperiores quod velit minima officia accusamus cumque eligendi consequuntur fuga? Maiores, quasi, voluptates, exercitationem fuga voluptatibus a repudiandae expedita omnis molestiae alias repellat perferendis dolores dolor.</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                        <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-lock3"></i>Is Mobitrash Just A Private Garbage Transport Service Providers.</div>
                        <div class="acc_content clearfix">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</div>

                    </div>

                </div>


            </div>
        </div>


    </div>

</section><!-- #content end -->

@stop