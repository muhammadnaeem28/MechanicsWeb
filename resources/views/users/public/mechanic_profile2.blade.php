@extends('users.layouts.public.master')
@section('title')
    Mechanic Profile
    @parent
@endsection


@section('styles')

    <style>
        .social_block{
            clear: both;
            width: auto;
            }
        .fb_btn{

            clear: both;
            width: auto;
        }
        .twitter_btn{}
    </style>

@endsection

@section('content')

    {{--//img/profile-bg.jpg--}}
{{--//<section class="parallax-window" data-parallax="scroll" data-image-src="/img/profile-bg.jpg" >--}}{{--data-natural-width="1400" data-natural-height="470"--}}

    <div class="row" style="background: url('/img/profile-bg.jpg') no-repeat; background-size: cover; padding:150px 0 30px 0; ">

            <div id="tour_guide" style="clear: both; color:#fff">
                <p>
                    <img src="/web_content/img/default_img.png" width="220" height="220" alt="" class="img-circle styled">
                </p>
                <h2 style="color:#fff" >Robert will</h2>
                <p>
                    <i class="icon-location-2"></i> Lahore, Pakistan
                    &nbsp;
                    <i class="icon_set_1_icon-37"></i>3 Years of Experience
                    &nbsp;
                    <i class="icon_set_1_icon-18"></i> <span st1yle="margin: 0px;">10 reviews</span>

                    <span class="rating" style="font-size: 13px;"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i></span>

                </p>
                <p class="lead">
                <div class="social_block">
                    <div class="fb_btn">
                        <div class="fb-like" data-href="{{Request::url()}}" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
                    </div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));

                    </script>
                </div>
                </p>
            </div>


            <!-- end row -->

    </div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>About Me</h3>
            <p>

                I am a master mechanic with over 25 years of experience. I'm also a transmission specialist. My motto is simple: I will take care of your car like my mother's car. My truck is fully loaded with everything I need to fix your car at your location. No job is too big or too small -- I will go the extra mile to make sure you're happy.
            </p>
        </div>
        <div class="col-md-4">
            <h3>Spoken Languages</h3>
                    <p>
                        English | Urdu
                    </p>
        </div>
    </div>
</div>


    <div class="container margin_30">
        <div class="main_title">
            <h2>Customer Reviews</h2>
        </div>
        <div class="row">

{{--            @for($i=0;$i<$total_comments;$i++)

                <div class="col-md-8 col-md-offset-2">
                    <div class="review_strip">
                        <img src="{{$comments[$i]->image_url}}" style="width:80px; height: 80px;" alt="" class="img-circle">
                        <h4>{{$comments[$i]->name}}</h4>
                        <p>
                            {{$comments[$i]->comment}}
                        </p>

                    </div><!-- End review strip -->
                </div>

            @endfor--}}
                <div class="col-md-8 col-md-offset-2">
                    <div class="review_strip">
                        <img src="/web_content/img/default_img.png" style="width:80px; height: 80px;" alt="" class="img-circle">
                        <h4>Ali Raza</h4>
                        <p>
                            THis mechanic is really really good in his work. Recommended.
                        </p>
                        <p>
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i></span> on July 24, 2016
                        </p>
                    </div><!-- End review strip -->
                </div>


        </div><!-- End row -->
        <div class="col-xs-8 col-xs-offset-2 add_bottom_30">
            <div class="main_title">
                <h4><a class="btn_1" href="#" style="color: black;">
                        Leave a review</a></h4>
            </div>
        </div>


    </div>
{{--</section>--}}
   {{-- <section class="parallax-window" data-parallax="scroll" data-image-src="/img/profile-bg.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container" >
                <div class="row" >
                    <div class="col-xs-12">

                        <div class="col-xs-3 col-xs-offset-1" style="border:1px solid red;">
                            <p>
                                <img src="/web_content/img/default_img.png" width="170" height="170" alt="" class="img-circle styled">
                            </p>
                        </div>
                        <div class="col-xs-8 " style="border:1px solid blue;">
                            <p style="margin: 0px; font-size: 20px;">sadasdasdasdas</p>
                            <h1>asdasdas dasd asdas das da</h1>
                            <p style="margin: 0px; font-size: 18px;"><a href="3" style="color:#fff"> asdasd asd asd asd}</a></p>
                            <span st1yle="margin: 0px;">23 reviews</span>
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-smile"></i></span>
                            <div class="social_block">
                                <div class="fb_btn">
                                    <div class="fb-like" data-href="{{Request::url()}}" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
                                </div>

                                <div class="twitter_btn">
                                    <a href="{{Request::url()}}" class="twitter-share-button">Tweet</a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                </div>
                            </div>
                        </div>

                    </div>
                    --}}{{--
                                    <div class=" col-xs-2">
                                        <div id="price_single_main">
                                            <span><sup>$</sup>52</span>
                                            <br>
                                            per person
                                            <br>
                                            for 3 Hours
                                        </div>
                                    </div>
                    --}}{{--
                </div>
            </div>
        </div>
    </section><!-- End section -->--}}
    <br>
    <br>
@endsection
