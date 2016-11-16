@extends('users.layouts.public.master')
@section('title')
    Home Page
    @parent
@endsection


    @section('styles')
    {!! HTML::style('/css/homepage/flip.css') !!}
    {!! HTML::style('/css/homepage/prettify.css') !!}
    @endsection



    @section('content')
            <!-- Slider -->
    <section id="hero">
        <div class="intro_title">
            <h1 class="animated fadeInDown">Car Maintenance goes Online</h1>
            <p class="animated fadeInDown">Priodic Maintenance & VAS at your doorstep through easy online bookings.</p>
            <a href="#" class="animated fadeInUp button_intro">Get an Instant Quotation</a>
            <a href="#" class="animated fadeInUp button_intro outline">Book an Appointment</a>
        </div>
    </section><!-- End hero -->
   <!-- End Slider -->


    <div class="container margin_60">
        <div class="main_title">
            <h2><span>Services</span></h2>
            <p>
                Our value added services
            </p>
        </div>
        <hr>
        <div id="grid-containter" style="text-align: center;">

            <a href="http://filddy.com/appointment_form#/13">
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Oil Change and Filter</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p> Change Oil and Filter of your car </p>
                    <h4 class="titleService">Oil Change and Filter</h4>
                </div>
            </div>
            </a>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
            <div class="card-grid">
                <div class="front">
                    <div>
                        <img src="/img/services/flip.png" alt="">
                        <h4 class="titleService">Service</h4>
                    </div>
                </div>
                <div class="back">
                    <h2>$202</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                    <h4 class="titleService">Service</h4>
                </div>
            </div>
        </div>
    </div>





@endsection



@section('scripts')
    <script src="/js/homepage/prettify.min.js"></script>
    <script src="/js/homepage/jquery.flip.min.js"></script>

    <script>

        prettyPrint();

        $(".card-grid").flip({
            trigger: 'hover'
        });

    </script>

@endsection
