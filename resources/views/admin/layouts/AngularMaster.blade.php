

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

<!--<![endif]-->

<!-- BEGIN HEAD -->



<head>

    <meta charset="utf-8" />

    <title>Autogenie Admin : @yield('title')</title>



    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />



    {{--

        <script>

            $("input[name='demo3']").TouchSpin();

        </script>

    --}}





    {{--<base href="/adminn">--}}

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    {!! HTML::style('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}

    {!! HTML::style('/admin/global/plugins/font-awesome/css/font-awesome.min.css') !!}

    {!! HTML::style('/admin/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}

    {!! HTML::style('/admin/global/plugins/bootstrap/css/bootstrap.min.css') !!}

    {!! HTML::style('/admin/global/plugins/uniform/css/uniform.default.css') !!}



    {!! HTML::style('/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}



    {!! HTML::style('/admin/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css') !!}

            <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->

    {!! HTML::style('/admin/global/css/plugins.css') !!}

    {!! HTML::style('/admin/global/css/components.css') !!}

    {!! HTML::style('/css/sweetalerts.css') !!}

    {{--{!! HTML::style('/admin/pages/css/tasks.css') !!}--}}

            <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->

    {!! HTML::style('/admin/layouts/layout/css/layout.css') !!}

    {!! HTML::style('/admin/layouts/layout/css/themes/darkblue.min.css') !!}

    {{--{!! HTML::style('/admin/layouts/layout/css/themes/default.css') !!}--}}

    {!! HTML::style('/admin/layouts/layout/css/custom.css') !!}

            <!-- END THEME LAYOUT STYLES -->



    @yield('styles')





    <link rel="shortcut icon" href="favicon.ico" /> </head>

<!-- END HEAD -->



<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">

<!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">

    <!-- BEGIN HEADER INNER -->

    <div class="page-header-inner ">

        <!-- BEGIN LOGO -->

        <div class="page-logo">

            <a href="{{route('admin.dashboard')}}">

                <img src="/img/logo-1.png" alt="logo" class="logo-default" style="background-color: white;margin-top:7px;"/> </a>

            <div class="menu-toggler sidebar-toggler"> </div>

        </div>

        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->

        @include('admin.layouts.partials.navbar')

                <!-- END TOP NAVIGATION MENU -->

    </div>

    <!-- END HEADER INNER -->

</div>

<!-- END HEADER -->

<!-- BEGIN HEADER & CONTENT DIVIDER -->

<div class="clearfix"> </div>

<!-- END HEADER & CONTENT DIVIDER -->

<!-- BEGIN CONTAINER -->

<div class="page-container" ng-app="main-App">

    <!-- BEGIN SIDEBAR -->

    @include('admin.layouts.partials.sidebar')

            <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->

    <div class="page-content-wrapper">



        @yield('content')

        <ng-view></ng-view>



    </div>

    <!-- END CONTENT -->

    @include('admin.layouts.SRDashboard.partials.rightbar')

</div>

{!! HTML::script('/js/sweetalerts.js') !!}

@include('sweet::alert')



        <!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<div class="page-footer">

    <div class="page-footer-inner"> 2016 &copy; autogenie.pk

    </div>

    <div class="scroll-to-top">

        <i class="icon-arrow-up"></i>

    </div>

</div>

<!-- END FOOTER -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script>

<![endif]-->

<!-- BEGIN CORE PLUGINS -->



{!! HTML::script('/admin/global/plugins/jquery.min.js') !!}

{!! HTML::script('/admin/global/plugins/bootstrap/js/bootstrap.min.js') !!}

{!! HTML::script('/admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}

{!! HTML::script('/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}

{!! HTML::script('/admin/global/plugins/jquery.blockui.min.js') !!}



{!! HTML::script('/admin/global/plugins/uniform/jquery.uniform.min.js') !!}

{!! HTML::script('/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}



{!! HTML::script('/admin/global/plugins/morris/morris.min.js') !!}

{!! HTML::script('/admin/global/plugins/morris/raphael-min.js') !!}

{!! HTML::script('/admin/global/plugins/counterup/jquery.waypoints.min.js') !!}

{!! HTML::script('/admin/global/plugins/counterup/jquery.counterup.min.js') !!}







{!! HTML::script('/admin/pages/scripts/components-bootstrap-touchspin.min.js') !!}

{!! HTML::script('/admin/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') !!}





        <!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

{!! HTML::script('/admin/global/scripts/app.js') !!}

{!! HTML::script('/admin/layouts/layout/scripts/layout.js') !!}

{!! HTML::script('/admin/layouts/global/scripts/quick-sidebar.js') !!}



        <!-- END PAGE LEVEL SCRIPTS -->







<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

<!-- MY App -->

{!! HTML::script('/angular/route.js') !!}

{!! HTML::script('/angular/packages/dirPagination.js') !!}

{!! HTML::script('/angular/services/myServices.js') !!}

{!! HTML::script('/angular/helper/myHelper.js') !!}



{!! HTML::script('/angular/services/pricingServices.js') !!}

{!! HTML::script('/angular/services/VehicleServices.js') !!}



        <!-- App Controller -->

<script src="{{ asset('/angular/controllers/ItemController.js') }}"></script>

<script src="{{ asset('/angular/controllers/PricingController.js') }}"></script>

<script src="{{ asset('/angular/controllers/VehicleController.js') }}"></script>

{{--

{!! HTML::script('/admin/global/plugins/bootstrap-select/js/bootstrap-select.js') !!}

{!! HTML::style('/admin/global/plugins/bootstrap-select/css/bootstrap-select.css') !!}

--}}

@yield('scripts')

</body>



</html>