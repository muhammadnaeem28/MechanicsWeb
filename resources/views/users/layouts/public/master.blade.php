<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="template, tour template, city tours, city tour, tours tickets, transfers, travel, travel template" />
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    @yield('meta')
    <title>Autogenie.pk @yield('title')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    {{--<link href="css/base.css" rel="stylesheet">--}}

    <!-- Google web fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
{{--
    <link href="rs-plugin/css/settings.css" rel="stylesheet">
    <link href="css/extralayers.css" rel="stylesheet">
--}}

    <!-- BASE CSS -->
    {!! HTML::style('/css/base.css') !!}
            <!-- Google web fonts -->
    {!! HTML::style('//fonts.googleapis.com/css?family=Montserrat:400,700') !!}
    {!! HTML::style('//fonts.googleapis.com/css?family=Gochi+Hand') !!}
    {!! HTML::style('//fonts.googleapis.com/css?family=Lato:300,400') !!}
            <!-- REVOLUTION SLIDER CSS -->
    {!! HTML::style('/rs-plugin/css/settings.css') !!}
    {!! HTML::style('/css/extralayers.css') !!}

    <!--[if lt IE 9]>
    {!! HTML::style('/js/html5shiv.min.js') !!}
    {!! HTML::style('/js/respond.min.js') !!}
    <![endif]-->
    @yield('styles')
</head>

<body>

<!--[if lte IE 8]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

<div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<!-- End Preload -->

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<!-- BEGIN Header -->
@include('users.layouts.public.partials.navbar')
<!-- End Header -->

<div class="page-main-container">
    @yield('content')
</div>

{!! HTML::script('/js/sweetalerts.js') !!}
@include('sweet::alert')

<!-- BEGIN footer -->
@include('users.layouts.public.partials.footer')
<!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

<!-- Common scripts -->
{!! HTML::script('/js/jquery-1.11.2.min.js') !!}
{!! HTML::script('/js/common_scripts_min.js') !!}
{!! HTML::script('/js/functions.js') !!}

<!-- END Common scripts -->


<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
{{--<script src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="js/revolution_func.js"></script>--}}


@yield('scripts')
</body>

</html>