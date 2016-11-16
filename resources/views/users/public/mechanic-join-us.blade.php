@extends('users.layouts.public.master')
@section('title')
    Customer Login
    @parent
@endsection

@section('styles')
    {!! HTML::style('/css/custom.css') !!}
@endsection
@section('content')



            <!---->

    <section class="section section--top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="section__h1">
                        Take your career as an automotive technician to the next level
                    </h1>
                    <h2 class="section__h2">
                        Join the #1 mobile mechanic team in the country
                    </h2>
                </div>
                <div class="col-md-4 sct">
                    <div class="box mech-form">
                        <h4 class="box__heading">
                            Apply now!
                        </h4>
                        <p class="box__text">
                            Fill out this short form to get started.
                        </p>
                        <div id="MechanicAppStartForm-react-component-1">
                            <div data-reactid=".ehniuvvh8g" >
                                    <form method="POST" action="{{ route('mechanic.join-us.submit') }}" class="cd-form floating-labels shadow-box-fill">
                                    <fieldset class="mechanic-form-padding" >
                                        <div>
                                            <div class="icon">
                                                {{--<label class="cd-label" for="application-user-name1" >Name</label>--}}
                                                <label class="cd-label float" for="application-user-name1">Name</label>
                                                <input style="padding-left: 10px!important;" name="fname" type="text" class="user" id="application-user-name1" value="" >
                                                {{ $errors->first('fname') }}
                                            </div>
                                            <div class="icon">
                                                <label class="cd-label float" for="application-user-email1" >Email</label>
                                                <input style="padding-left: 10px!important;" name="email" type="text" class="email" id="application-user-email1" value=""  >
                                                {{ $errors->first('gmail') }}
                                            </div>
                                            <div class="icon" >
                                                <label class="cd-label float" for="application-user-phone1" >Phone number</label>
                                                <input style="padding-left: 10px!important;" name="phone1" type="text" class="phonenumber" id="application-user-phone1" value="" >
                                                {{ $errors->first('phone1') }}
                                            </div>
                                            <button type="submit" class="btn-blue-fill" id="test-button-optimizely" data-reactid=".ehniuvvh8g.0.0.0.7">APPLY NOW</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="features-positioner col-md-8">
                    <div class="row">
                        <div class="feature col-sm-4">
                            <h4 class="feature__heading">
                                FLEXIBLE HOURS
                            </h4>
                            <p class="feature__text">
                                Work evenings, weekends, or full-time -- you decide!
                            </p>
                        </div>
                        <div class="feature col-sm-4">
                            <h4 class="feature__heading">
                                GREAT PAY
                            </h4>
                            <p class="feature__text">
                                Make $40-$60 hourly -- 2-3x what shops &amp; dealers pay you.
                            </p>
                        </div>
                        <div class="feature col-sm-4">
                            <h4 class="feature__heading">
                                BE YOUR OWN BOSS
                            </h4>
                            <p class="feature__text">
                                You choose the type of jobs, where to work, and when to work. No politics or managers!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section--white">
        <div class="container">
            <div class="row spaceb-40">
                <div class="col-lg-12 featured-section">
                    <p class="justify-image-flex"><span>FEATURED ON</span>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image1.png">
                        </a>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image2.png">
                        </a>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image3.png">
                        </a>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image4.png">
                        </a>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image5.png">
                        </a>
                        <a href="" target="_blank">
                            <img data-no-retina="true" src="img/featured_images/feature_image6.png">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section section--white section--features text-center">
        <div class="container">
            <h3 class="section__h3">
                Why are thousands of mechanics joining us?
            </h3>
            <div class="row">
                <div class="feature col-sm-4">
                    <div class="feature__icon">
                        <img alt="Feature1%403x" src="img/featured_images/feature1@3x.png">
                    </div>
                    <h4 class="feature__heading">
                        CHOOSE YOUR SCHEDULE
                    </h4>
                    <p class="feature__text">
                        One day a week? 5 days a week? Just evenings? Weekends only? You have total control. You can simply use our Android app to set your own hours and we will book you appointments based on your availability.
                    </p>
                </div>
                <div class="feature col-sm-4">
                    <div class="feature__icon">
                        <img alt="Feature2%403x" src="img/featured_images/feature2@3x.png">
                    </div>
                    <h4 class="feature__heading">
                        FAIR PAY
                    </h4>
                    <p class="feature__text">
                        Our mechanics make anywhere between $40-$60 an hour based on their location, skills and level of experience. We pay flat rate and we don’t do any warranty work. You get paid fairly.
                    </p>
                </div>
                <div class="feature col-sm-4">
                    <div class="feature__icon">
                        <img alt="Feature3%403x" src="img/featured_images/feature3@3x.png">
                    </div>
                    <h4 class="feature__heading">
                        NO COMPLEX JOBS
                    </h4>
                    <p class="feature__text">
                        We focus on basic repair and maintenance work -- brakes, tire rotations, timing belts, 30/60/90k service, alternators, A/C, etc. No engine overhauls or major transmission work.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="feature col-sm-4 col-sm-offset-2">
                    <div class="feature__icon">
                        <img alt="Feature4%403x" src="img/featured_images/feature4@3x.png">
                    </div>
                    <h4 class="feature__heading">
                        FOCUS ON WHAT YOU LOVE
                    </h4>
                    <p class="feature__text">
                        We handle marketing, booking appointments, delivering parts, buying insurance and providing support. You do what you love - fix cars. We take care of the rest.
                    </p>
                </div>
                <div class="feature col-sm-4">
                    <div class="feature__icon">
                        <img alt="Feature5%403x" src="img/featured_images/feature5@3x.png">
                    </div>
                    <h4 class="feature__heading">
                        WIN-WIN FOR EVERYONE
                    </h4>
                    <p class="feature__text">
                        When you work directly with car owners in your neighborhood, you can make more money with no commute. Plus, car owners enjoy the convenience. Everyone wins.
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-centered">
                    <div class="text-center">
                        <a class="button button--blue button--fullwidth button--radius"  href=""  >
                            Apply now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section section--white section--mechanics">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-offset-0">
                    <h3 class="section__h3">What do our mechanics say?</h3>
                    <div class="row">
                        <article class="reference col-sm-6">
                            <div class="reference__header">
                                <img class="reference__avatar" src="img/featured_images/avatar(5).jpg">
                                <div class="reference__author">
                                    <a class="logos__item" href="https://www.autogenie.com/pro/mparra" target="_">
                                        <h5 class="reference__author__name">
                                            Michael P.
                                        </h5>
                                    </a>
                                    <p class="reference__author__position">
                                        Working for autogenie since 2014
                                    </p>
                                </div>
                            </div>
                            <div class="reference__content">
                                <p>
                                    “What I like best is the freedom and flexibility with my schedule, and not having a foreman or service manager hanging over me. Meeting customers is fun. I like chatting with them and seeing their face when the car is repaired at their home and they didn't have to waste time at a repair facility.”
                                </p>
                            </div>
                        </article>
                        <article class="reference col-sm-6">
                            <div class="reference__header">
                                <img class="reference__avatar" src="img/featured_images/avatar(6).jpg">
                                <div class="reference__author">
                                    <a class="logos__item" href="https://www.autogenie.com/pro/lucas" target="_">
                                        <h5 class="reference__author__name">
                                            Lucas D.
                                        </h5>
                                    </a>
                                    <p class="reference__author__position">
                                        Working for autogenie since 2014
                                    </p>
                                </div>
                            </div>
                            <div class="reference__content">
                                <p>
                                    “I love working according my schedule, at the times I set. When I want to be extra busy, the additional income is great. I love the fact that I can focus on the car issues and the office will take care of the customer billing. That way, I can do what I love to do: fix cars and put a smile on people's faces."
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="row">
                        <article class="reference col-sm-6">
                            <div class="reference__header">
                                <img class="reference__avatar" src="img/featured_images/avatar(7).jpg">
                                <div class="reference__author">
                                    <a class="logos__item" href="https://www.autogenie.com/pro/wendy" target="_">
                                        <h5 class="reference__author__name">
                                            Wendy E.
                                        </h5>
                                    </a>
                                    <p class="reference__author__position">
                                        Working for autogenie since 2016
                                    </p>
                                </div>
                            </div>
                            <div class="reference__content">
                                <p>
                                    “All of it, really. No middle man messing everything up. Direct contact with my clients. Leaving no room for miscommunication. The app keeps everything precise and simple. Everyone in the office is very helpful.”
                                </p>
                            </div>
                        </article>
                        <article class="reference col-sm-6">
                            <div class="reference__header">
                                <img class="reference__avatar" src="img/featured_images/avatar.jpg">
                                <div class="reference__author">
                                    <a class="logos__item" href="https://www.autogenie.com/pro/mlenhart" target="_">
                                        <h5 class="reference__author__name">
                                            Mark L.
                                        </h5>
                                    </a>
                                    <p class="reference__author__position">
                                        Working for autogenie since 2014
                                    </p>
                                </div>
                            </div>
                            <div class="reference__content">
                                <p>
                                    “Being mobile, working for myself, making my own schedule, close customer relationships. Making customers happy."
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-centered">
                            <div class="text-center">
                                <a class="button button--blue button--fullwidth button--radius"  href=""  >
                                    Apply now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section section--dark">
        <div class="container">
            <h3 class="section__h3 text-center">
                Joining autogenie is as easy as 1-2-3
            </h3>
        </div>
        <div class="options">
            <div class="container">
                <div class="row">
                    <div class="option col-sm-4">
                        <div class="option__number">
                            1
                        </div>
                        <h4 class="option__heading">
                            EASY ONLINE APPLICATION
                        </h4>
                        <p class="option__text">
                            It takes less than 10 minutes to fill out the entire application. If you have questions, call us at 1-800-701-6230.
                        </p>
                    </div>
                    <div class="option col-sm-4">
                        <div class="option__number">
                            2
                        </div>
                        <h4 class="option__heading">
                            PHONE INTERVIEW &amp; ONBOARDING
                        </h4>
                        <p class="option__text">
                            A service advisor will call you to interview you and provide more information about how autogenie works.
                        </p>
                    </div>
                    <div class="option col-sm-4">
                        <div class="option__number">
                            3
                        </div>
                        <h4 class="option__heading">
                            START WORKING
                        </h4>
                        <p class="option__text">
                            Make $40-60 an hour based on your skills and experience. Set your own hours -- choose evenings, weekends, or full-time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-centered">
                    <div class="text-center">
                        <a class="button button--blue button--fullwidth button--radius"  href=""  >
                            Apply now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section section--white">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-centered">
                    <h3 class="section__h3 text-center">
                        More About autogenie
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-centered">
                    <p class="section__p text-center">
                        We offer flexible hours, great pay and freedom to be your own boss. We are growing fast -- our mechanics serve thousands of customers each month in over 700 cities. Join us today!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="about col-sm-4">
                    <div class="about__icon">
                        <img alt="About1%403x" src="img/featured_images/about1@3x.png">
                    </div>
                    <h3 class="about__heading">
                        1,000+
                    </h3>
                    <p class="about__text">
                        Over 1,000 mechanics work with us
                        <br> in 20+ states
                    </p>
                </div>
                <div class="about col-sm-4">
                    <div class="about__icon">
                        <img alt="About2%403x" src="img/featured_images/about2@3x.png">
                    </div>
                    <h3 class="about__heading">
                        2,500,000+
                    </h3>
                    <p class="about__text">
                        More than 2.5 million people visit
                        <br> autogenie.com every month
                    </p>
                </div>
                <div class="about col-sm-4">
                    <div class="about__icon">
                        <img alt="About3%403x" src="img/featured_images/about3@3x.png">
                    </div>
                    <h3 class="about__heading">
                        Uber, Lyft
                    </h3>
                    <p class="about__text">
                        We work with large fleet accounts
                        <br> like Uber and Lyft.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-centered">
                    <div class="text-center">
                        <a class="button button--blue button--fullwidth button--radius"  href=""  >
                            Apply now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="section section--gray">
        <div class="container">
            <h3 class="section__h3 text-center">
                We're currently hiring in these cities:
            </h3>
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="general-list">
                        <ul>
                            <li>
                                <a href="">Albuquerque, NM</a>
                            </li>
                            <li>
                                <a href="">Atlanta, GA</a>
                            </li>
                            <li>
                                <a href=" ">Austin, TX</a>
                            </li>
                            <li>
                                <a href=" ">Baltimore, MD</a>
                            </li>
                            <li>
                                <a href="  ">Boise, ID</a>
                            </li>
                            <li>
                                <a href="  ">Boston, MA</a>
                            </li>
                            <li>
                                <a href="  ">Charleston, SC</a>
                            </li>
                            <li>
                                <a href="  ">Charlotte, NC</a>
                            </li>
                            <li>
                                <a href="  ">Chicago, IL</a>
                            </li>
                            <li>
                                <a href=" ">Cincinnati, OH</a>
                            </li>
                            <li>
                                <a href=" ">Columbia, SC</a>
                            </li>
                            <li>
                                <a href=" ">Columbus, OH</a>
                            </li>
                            <li>
                                <a href="  ">Dallas-Fort Worth, TX</a>
                            </li>
                            <li>
                                <a href=" ">Denver, CO</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="general-list">
                        <ul>
                            <li>
                                <a href="">Des Moines, IA</a>
                            </li>
                            <li>
                                <a href="">Fresno, CA</a>
                            </li>
                            <li>
                                <a href="">Fort Lauderdale, FL</a>
                            </li>
                            <li>
                                <a href="">Fort Myers-Naples, FL</a>
                            </li>
                            <li>
                                <a href="">Houston, TX</a>
                            </li>
                            <li>
                                <a href="">Indianapolis, IN</a>
                            </li>
                            <li>
                                <a href="">Jacksonville, FL</a>
                            </li>
                            <li>
                                <a href="">Kansas City, KS</a>
                            </li>
                            <li>
                                <a href="">Las Vegas, NV</a>
                            </li>
                            <li>
                                <a href="">Los Angeles, CA</a>
                            </li>
                            <li>
                                <a href="">Louisville, KY</a>
                            </li>
                            <li>
                                <a href="">Madison, WI</a>
                            </li>
                            <li>
                                <a href="">Miami, FL</a>
                            </li>
                            <li>
                                <a href="">Minneapolis-St. Paul, KS</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="general-list">
                        <ul>
                            <li>
                                <a href="">Nashville, TN</a>
                            </li>
                            <li>
                                <a href="">Newark, NJ</a>
                            </li>
                            <li>
                                <a href="">Norfolk, CT</a>
                            </li>
                            <li>
                                <a href="">Oklahoma City, OK</a>
                            </li>
                            <li>
                                <a href="">Orlando, FL</a>
                            </li>
                            <li>
                                <a href="">Philadelphia, PA</a>
                            </li>
                            <li>
                                <a href="">Phoenix, AZ</a>
                            </li>
                            <li>
                                <a href="">Pittsburgh, PA</a>
                            </li>
                            <li>
                                <a href="">Portland, OR</a>
                            </li>
                            <li>
                                <a href="">Raleigh, NC</a>
                            </li>
                            <li>
                                <a href="">Richmond, VA</a>
                            </li>
                            <li>
                                <a href="">Sacramento, CA</a>
                            </li>
                            <li>
                                <a href="">Salt Lake City, UT</a>
                            </li>
                            <li>
                                <a href="">San Antonio, TX</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="general-list">
                        <ul>
                            <li>
                                <a href="">San Diego, CA</a>
                            </li>
                            <li>
                                <a href="">San Francisco Bay Area, CA</a>
                            </li>
                            <li>
                                <a href="">Santa Barbara, CA</a>
                            </li>
                            <li>
                                <a href="">Savannah, GA</a>
                            </li>
                            <li>
                                <a href="">Seattle, WA</a>
                            </li>
                            <li>
                                <a href="">Saint Louis, MO</a>
                            </li>
                            <li>
                                <a href="">Tampa, FL</a>
                            </li>
                            <li>
                                <a href="">Tucson, AZ</a>
                            </li>
                            <li>
                                <a href="">Tulsa, OK</a>
                            </li>
                            <li>
                                <a href="">Washington, DC</a>
                            </li>
                            <li>
                                <a href="">West Palm Beach, FL</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container spacet-30">
            <div class="row">
                <div class="col-sm-4 col-centered">
                    <div class="text-center">
                        <a class="button button--blue button--fullwidth button--radius" href="">
                            Apply now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
