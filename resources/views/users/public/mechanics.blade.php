@extends('users.layouts.public.master')
@section('title')
    Mechanics page
    @parent
@endsection


@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="/img/bg/bg7.jpg" data-natural-width="1200" data-natural-height="370">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Mechanics</h1>
                <p>Hand Picked, Community Rated Pros</p>
            </div>
        </div>
    </section>

    <div class="container margin_60">

        <div class="main_title">
            <h2>Autogenie's Top mechanics</h2>
            <p>Check out our most rated mechanics</p>
        </div>

        <div class="row">
            @foreach($mechanics as $mechanic)

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="tour_container">
                        <div class="img_container">

                            <?php
                            $mechanic_fname = $mechanic->fname;
                            $mechanic_lname = $mechanic->lname;
                            $mechanic_name = $mechanic_fname .'-'. $mechanic_lname ;

                            $name = preg_replace('/\s+/','-',$mechanic_name );
                            ?>
                            <a href="{{route('mechanics.profile',['id'=>$mechanic->id,'name'=>$name])}}">
                                <img src="{{$mechanic->image_url}}" class="img-responsive" alt="">
                            </a>

                        </div>
                        <div class="tour_title" style="padding-top: 8px; padding-bottom: 8px;">
                            <div style="height: 38px;">
                                <h3>{{$mechanic->fname}} {{$mechanic->lname}}</h3>
                            </div>
                            <div class="rating">
                                <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i>
                            </div><!-- end rating -->
                        </div>

                    </div><!-- End box tour -->
                </div><!-- End col-md-4 -->

            @endforeach
        </div>



    </div>

@endsection
