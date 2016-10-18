@extends('frontend.layouts.site')
@section('content')
<!-- <section id="slider" class="slider-parallax loginsec" data-height-lg="300" data-height-md="300" data-height-sm="250px" data-height-xs="250" data-height-xxs="200">
    <div class="slider-parallax-inner">
        <div class="container clearfix">
            <div class="vertical-middle verticalmid">
                <div class="heading-block nobottomborder">
                    <h1>
                        <div>
                            <span>FAQ</span>
                        </div>
                    </h1>
                    <p>We Are Happy To Answers Your Questions</p>
                </div>
            </div> 
        </div>
    </div>
</section> -->
 <div class="content-wrap" style="background: url('{{asset('public/Frontend/images/parallax/home/clouds-background.jpg')}}') no-repeat;
    background-size: 100% auto;;
    padding-bottom: 3px;
    padding-top: 19px;">
    <div class="container clearfix">
        <div class="row">
           <div class="container">
            <div class="entry-title entry-title-tc" style="margin-top:30px;">
                <h2>FAQ</h2>
            </div>
            </div>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">

                <div class="accordion accordion-border clearfix" data-state="closed">

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>Is MobiTrash just a private garbage transport service provider?</div>
                    <div class="acc_content clearfix">No! MobiTrash is India’s first and most unique technological service provider which treats your segregated organic waste inside your premises daily and generates nuisance free ‘raw compost’ which is taken away to a central location for further composting.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        Is MobiTrash a free service?</div>
                    <div class="acc_content clearfix">
                        No! It is a subscription based paid service – only Rs.199 per household per month! </div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        Which all cities does MobiTrash operate in?</div>
                    <div class="acc_content clearfix">
                        Currently we have launched our service in Pune. If you’re not from Pune, rest assured! We shall be coming to your city soon.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        I am interested to sign up for MobiTrash. but can I see a demonstration before actually signing up?</div>
                    <div class="acc_content clearfix">
                        Yes! Just drop us a line. We will be happy to organize a demonstration for you at one of the existing sites in your city. We shall ensure that you see it, to believe it!</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        I am a flat owner in a building. Can I subscribe for MobiTrash just for my flat?</div>
                    <div class="acc_content clearfix">
                        Currently we do not provide this service for single flats. The service is provided to residential buildings or complexes with at least 25 – 50 homes per building. </div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        I am a commercial establishment. Is MobiTrash available for me?</div>
                    <div class="acc_content clearfix">
                        Of course! MobiTrash is available for commercial bulk waste generators such as office complexes, IT companies, wedding halls, factories, malls, hotels and restaurants. </div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        Will you accept all garbage that we generate?</div>
                    <div class="acc_content clearfix">As the tagline for MobiTrash suggests, it is ‘composting on wheels’ service. We shall only accept segregated organic (bio degradable) waste for treatment and transport.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        Is there an upper limit to the quantity of garbage that can be given?</div>
                    <div class="acc_content clearfix">
                        For households, yes. A maximum of 0.5 kg of garbage per day per household can be given for treatment in MobiTrash.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                        Will you collect door-to-door?</div>
                    <div class="acc_content clearfix">
                        No. The segregated organic waste has to be brought to the MobiTrash van in large plastic containers for treatment.</div>
                    
                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                    How much time does it take for the MobiTrash van to treat the organic waste at my site?</div>
                    <div class="acc_content clearfix">
                    As a rule of thumb, 100 kg of organic waste is treated in 30-45 minutes.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                    What if the MobiTrash van does not show up on a particular day?</div>
                    <div class="acc_content clearfix">
                    There could be few days in a year when the MobiTrash van would need some maintainence breaks. Still, it is our responsibility to ensure the waste is carted away from your premises in a timely manner.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                    What is the procedure for starting the MobiTrash service?</div>
                    <div class="acc_content clearfix">
                    It is very simple! You need to sign up for the service on our website www.MobiTrash.in. One of us will call you to set up an appointment with you fairly soon. We shall set up a free trial for a week. Mid-way during the trial period, we shall enter into a longer term commercial agreement with you.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                    ​Will there be bad smell generated from the MobiTrash van while it is parked in my premises and carrying out the treatment?</div>
                    <div class="acc_content clearfix">
                    As a part of our commitment to our clients, we make sure that you get a clean, 100% smell and nuisance free service day after day. Operators of the MobiTrash van are always equipped with safety equipment and shall make sure that waste is not left behind in your premises after treatment.</div>

                    <div class="acctitle"><i class="acc-closed icon-question-sign"></i><i class="acc-open icon-question-sign"></i>
                    Once we sign up, what time can we expect the MobiTrash van to come daily?</div>
                    <div class="acc_content clearfix">
                    As a part of the agreement, we shall mention a mutually agreeable daily time slot for the MobiTrash van to come and carry out the treatment at your premises.</div>

                </div>

            </div>


        </div>
    </div>
</div>
@stop