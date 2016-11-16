<!DOCTYPE html>



<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

<!--<![endif]-->

<!-- BEGIN HEAD -->



<head>

    <meta charset="utf-8" />

    <title>Autogenie.pk - Appointment Form</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <link href=
          "//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet" type="text/css">
    <link href="/admin/global/plugins/font-awesome/css/font-awesome.min.css"
          rel="stylesheet" type="text/css">
    <link href=
          "/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel=
          "stylesheet" type="text/css">
    <link href="/admin/global/plugins/bootstrap/css/bootstrap.min.css" rel=
    "stylesheet" type="text/css">
    <link href="/admin/global/plugins/uniform/css/uniform.default.css" rel=
    "stylesheet" type="text/css">
    <link href=
          "/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"><!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/global/plugins/select2/css/select2.min.css" rel=
    "stylesheet" type="text/css">
    <link href="/admin/global/plugins/select2/css/select2-bootstrap.min.css"
          rel="stylesheet" type="text/css"><!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/admin/global/css/components-md.min.css" id=
    "style_components" rel="stylesheet" type="text/css">
    <link href="/admin/global/css/plugins-md.min.css" rel="stylesheet" type=
    "text/css"><!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/admin/layouts/layout2/css/layout.min.css" rel="stylesheet"
          type="text/css">
    <link href="/admin/layouts/layout2/css/themes/blue.min.css" id=
    "style_color" rel="stylesheet" type="text/css">
    <link href="/admin/layouts/layout2/css/custom.min.css" rel="stylesheet"
          type="text/css">
    <!-- END THEME LAYOUT STYLES -->
    <link href="favicon.ico" rel="shortcut icon"><!-- JS -->
    <link rel="stylesheet" href="/js/fullcalendar/fullcalendar/dist/fullcalendar.css"/>

    <!-- load angular, nganimate, and ui-router -->


    <link href="/css/appointment/my_book.css" rel="stylesheet"
          type="text/css">
    
    <script type="text/javascript" src="/js/fullcalendar/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/js/fullcalendar/moment/min/moment.min.js"></script>

    {{--<script type="text/javascript" src="bower_components/angular/angular.min.js"></script>--}}

{{--
    <script src="https://code.angularjs.org/1.4.0-rc.0/angular.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.10/angular-ui-router.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script>
--}}


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.10/angular-ui-router.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script>



    <script src="/js/fullcalendar/ui-bootstrap-tpls-0.11.0.js"></script>

    <script type="text/javascript" src="/js/fullcalendar/angular-ui-calendar/src/calendar.js"></script>
    <script type="text/javascript" src="/js/fullcalendar/fullcalendar/dist/fullcalendar.min.js"></script>
    <script type="text/javascript" src="/js/fullcalendar/fullcalendar/dist/gcal.js"></script>
    <!--<script src="app.js"></script>-->



    <script src="/angular/controllers/MyBookCtrl.js">
    </script>




    {!! HTML::style('/admin/pages/css/login.min.css') !!}

    <link href="https://cdn.rawgit.com/zhaber/datetimepicker/master/datetimepicker.css" type="text/css" rel="stylesheet">

</head>

<!-- END HEAD -->



<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" ng-app="formApp">

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- BEGIN CONTAINER -->
<div class="page-container" ng-controller="SelectCarCtrl">
    <!-- views will be injected here -->
    <!--<div ui-view></div>-->
    <!-- -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- start select car-->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <!-- select car-->
                    <div class="portlet light">
                        <div class="portlet-body" id="select-car-box">
                            <h3><strong>Select your car</strong></h3>
                            <div>
                                <a ng-click="ChangeCarOption(item.type)" class="btn btn-outline" ng-repeat="item in carData" style="margin: 0 5px;"><% item.value %></a>
                            </div>

                            <!-- start make-list-->
                            <div class="car-list" ng-show="showMake">
                                <h3><strong>Make</strong></h3>
                                <div class="row hidden-xs">
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand1.length"><strong>A - G</strong></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand2.length"><strong>H - L</strong></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand3.length"><strong>M - P</strong></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand4.length"><strong>Q - Z</strong></div>
                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand1.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="brand1.length">
                                            <strong>A - G</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in brand1 = ( vehicleBrands | cfilter: 'A':'G') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectMake(obj)" > <% obj.name %>  <i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand2.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="brand2.length">
                                            <strong>H - L</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in brand2 = ( vehicleBrands | cfilter: 'H':'L') | orderBy: 'name'">
                                            <a class="list-group-item"  ng-click="selectMake(obj)"> <% obj.name %>  <i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand3.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="brand3.length">
                                            <strong>M - P</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in brand3 = ( vehicleBrands | cfilter: 'M':'P') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectMake(obj)"> <% obj.name %>  <i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3" ng-show="brand4.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="brand4.length">
                                            <strong>Q - Z</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in brand4 = ( vehicleBrands | cfilter: 'Q':'Z') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectMake(obj)"> <% obj.name %>  <i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end make-list-->
                            <!-- start year-list-->
                            <div class="car-list" ng-show="showYear">
                                <h3><strong>Year</strong></h3>
                                <div class="row hidden-xs">
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year1.length"><strong>2010 - 2017</strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year2.length"><strong>2000 - 2009</strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year3.length"><strong>1990 - 1999</strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year4.length"><strong>1980 - 1989</strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year5.length"><strong>1970 - 1979</strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year6.length"><strong>1960 - 1969</strong></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year1.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year1.length">
                                            <strong>2010 - 2017</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year1 = ( vehicleYears | nfilter: '2010':'2017') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year2.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year2.length">
                                            <strong>2000 - 2009</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year2 = ( vehicleYears | nfilter: '2000':'2009') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year3.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year3.length">
                                            <strong>1990 - 1999</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year3 = ( vehicleYears | nfilter: '1990':'1999') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year4.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year4.length">
                                            <strong>1980 - 1989</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year4 = ( vehicleYears | nfilter: '1980':'1989') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year5.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year5.length">
                                            <strong>1970 - 1979</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year5 = ( vehicleYears | nfilter: '1970':'1979') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2" ng-show="year6.length">
                                        <div class="hidden-lg hidden-md hidden-sm" ng-show="year6.length">
                                            <strong>1960 - 1969</strong>
                                            <hr>
                                        </div>
                                        <div class="list-group" ng-repeat="obj in year6 = ( vehicleYears | nfilter: '1960':'1969') | orderBy: 'name'">
                                            <a class="list-group-item" ng-click="selectYear(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>

                                        </div>
                                    </div>
                                </div>
                                <!--<div class="row">-->
                                <!--<a ng-click="selectYear('no')" class="btn btn-outline green pull-right">i don't know </a>-->
                                <!--</div>-->

                            </div>
                            <!-- end year-list-->
                            <!-- start model-list-->
                            <div class="car-list" ng-show="showModel">
                                <h3><strong>Model</strong></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4" ng-repeat="obj in vehicleModels">
                                        <div class="list-group">
                                            <a class="list-group-item" ng-click="selectModel(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="row">-->
                                <!--<a ng-click="selectModel('no')" class="btn btn-outline green pull-right">i don't know </a>-->
                                <!--</div>-->

                            </div>
                            <!-- end model-list-->
                            <!-- start trim-list-->
                            <div class="car-list" ng-show="showTrim">
                                <h3><strong>Trim</strong></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4" ng-repeat="obj in vehicleTrims">
                                        <div class="list-group">
                                            <a class="list-group-item" ng-click="selectTrim(obj)"><% obj %><i class="fa fa-check item-check-icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="row">-->
                                <!--<a ng-click="selectTrim('no')" class="btn btn-outline green pull-right">i don't know </a>-->
                                <!--</div>-->

                            </div>
                            <!-- end trim-list-->
                        </div>
                    </div>
                    <!--end select car-->
                    <!--start select service-->
                    <div id="service-box" ng-show="showServices">
                        <div class="portlet light services-box" >
                            <div class="portlet-body">
                                <h3><strong>Select your services</strong></h3>
                                <div style="border:1px solid #e7ebeb;">
                                    <div class="main-tab">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> REPAIR & MAINTENANCE SERVICES </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> DIAGNOSTICS & INSPECTIONS </a>
                                            </li>
                                        </ul>
                                        <div class="form-group row search-input">
                                            <div class="input-icon">
                                                <i class="fa fa-search"></i>
                                                <input type="text" class="form-control input-lg" placeholder="Search" ng-model="query" ng-change="searchService(query)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content" style="background-color: #F7F7F7">
                                        <div class="tab-pane fade active in " id="tab_1_1">
                                            <div class="row tab-services">
                                                <div class="col-lg-3 col-md-3 col-sm-3 tab-services-side-menu-list" ng-show="!searchTab">
                                                    <ul>
                                                        <li ng-class='{active:$first}' ng-repeat="obj in allServiceCategories">
                                                            <a ng-click="getServiceCategoryItems(obj)" data-toggle="tab"><% obj.name %></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 tab-content tab-services-side-list" ng-show="!searchTab">
                                                    <div class="tab-pane fade active in">
                                                        <p><%  serviceCategoryName  %></p>
                                                        <div class="list-group" ng-repeat="obj in serviceCategory">
                                                            <a class="list-group-item" ng-click="selectService(obj)"><i class="fa fa-plus-circle"></i><% obj.name %><span data-target="#full" data-toggle="modal">DETAIL</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade tab-services-side-list" id="tab_1_2" ng-show="!searchTab">
                                            <p>DIAGNOSTICS & INSPECTIONS</p>
                                            <div class="list-group" ng-repeat="obj in servicesInspection">
                                                <a class="list-group-item" ng-click="selectService(obj)"><i class="fa fa-plus-circle"></i><% obj.name %><span data-target="#full" data-toggle="modal">DETAIL</span></a>
                                            </div>
                                        </div>
                                        <div class="tab-services-side-list" ng-show="searchTab">
                                            <p>search</p>
                                            <div class="list-group" ng-repeat="obj in searchResult">
                                                <a class="list-group-item" ng-click="selectService(obj)"><i class="fa fa-plus-circle"></i><% obj.name %><span data-target="#full" data-toggle="modal">DETAIL</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="">I CAN'T FIND WHAT I NEED</a>
                                <!--</div>-->
                            </div>
                        </div>

                        <!--end select service-->
                        <!--start services sub view-->
                        <div ng-show="showServiceBrands" id="service-brands-box">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark bold uppercase"><% selectedServiceBrandName %></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-default" data-target="#full" data-toggle="modal">
                                            Details
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--<p><strong>Info : </strong> General Maintenance</p>-->
                                    <!--<div class="alert alert-info">-->
                                    <!--<strong>Info!</strong> You have 198 unread messages.-->
                                    <!--</div>-->

                                    <div class="car-list">
                                        <strong>Choose Brand :</strong>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4" ng-repeat="obj in selectedServiceBrand">
                                                <div class="list-group">
                                                    <a class="list-group-item" ng-click="chooseServiceBrand(obj)"><% obj.name %><i class="fa fa-check item-check-icon"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- start question-->
                        <div ng-show="showOptionalService" id="optionalService-box">
                            <div class="sub-question">
                                <!-- -->
                                <div class="timeline white-bg white-bg">
                                    <!-- TIMELINE ITEM -->
                                    <div class="timeline-item" ng-repeat="obj in optionalServiceList" ng-if="optionalService_index == $index">
                                        <div class="timeline-badge">
                                            <div class="timeline-badge-userpic">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="timeline-body">
                                            <div class="timeline-body-arrow"> </div>
                                            <div class="timeline-body-content">
                                                <div class="heading">
                                                    <h4><strong><% obj.name %></strong></h4>
                                                    <span><% $index+1 %>/<% optionalServiceList.length %></span>
                                                </div>
                                                <!--<p>If your car has vents that blow cold air on the driver and passengers, you have air conditioning.</p>-->
                                                <div>
                                                    <button type="button" class="btn blue btn-lg" ng-click="optionalServiceYes(obj)">YES</button>
                                                    <button type="button" class="btn grey-salsa btn-outline btn-lg" ng-click="optionalServiceNo(obj)">NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END TIMELINE ITEM -->
                                </div>
                            </div>
                            <!-- end question-->

                        </div>
                        <!--end services sub view-->
                        <!--<button type="button" class="btn blue btn-lg" ng-click="showData()">Show Data</button>-->
                        <!--</div>-->

                        <!-- start calendar-->
                        <div class="portlet light" ng-show="showCalendar" id="calendar-box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase">Select Date</span>
                                </div>
                                <div class="actions">
                                    <a class="btn btn-circle btn-default"  ng-click="dateTimeNow()">
                                        Now
                                    </a>
                                    <a class="btn btn-circle btn-default" ng-click="resetHours()">
                                        Reset
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="text-right">
                                    <span class="font-dark bold uppercase">total estimated service time <% totalTime %></span>
                                </div>
                                <!--<div ui-calendar="<% uiConfig.calendar %>" class="span8 calendar" ng-model="eventSources"></div>-->
                                <!-- -->
                                <br>
                                <div class="text-center">
                                    <form name="demo">
                                        <pre>Selected time and date is: <em><% date | date:'shortTime'  %>, <% date | date:'fullDate'  %></em></pre>

                                        <datetimepicker
                                                hour-step="hourStep"
                                                minute-step="minuteStep"
                                                ng-model="date"
                                                show-meridian="showMeridian"
                                                date-format="<% format %>"
                                                date-options="dateOptions"
                                                date-disabled="disabled(date, mode)"
                                                datepicker-append-to-body="false"
                                                readonly-date="false"
                                                disabled-date="false"
                                                hidden-time="false"
                                                hidden-date="false"
                                                name="datetimepicker"
                                                show-spinners="true"
                                                readonly-time="false"
                                                date-opened="dateOpened"
                                                show-button-bar="false"
                                        <!-- Use date-ng-click="open($event, opened)" to override date ng-click -->
                                        </datetimepicker>
                                    </form>
                                </div>

                                <!-- -->
                                <div class="text-right">
                                    <button type="button" class="btn blue btn-lg" ng-click="selectDateNextBtn()">Next</button>
                                </div>
                            </div>
                        </div>
                        <!-- end calendar-->

                        <!-- start login -->
                        <div class="portlet light" ng-show="showLoginForm" id="loginForm-box">
                            <div class="portlet-body login my-login" style="background-color: white !important;">

                                <!-- BEGIN LOGIN -->
                                <div class="content">
                                    <!-- BEGIN LOGIN FORM -->
                                    <form class="login-form" novalidate ng-submit="loginForm(user)" method="post">
                                        <h3 class="form-title font-green">Sign In</h3>
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            <span> Invalid Email or Password. </span>
                                        </div>
                                        <div class="form-group">
                                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                            <label class="control-label visible-ie8 visible-ie9">Email</label>
                                            <input class="form-control form-control-solid placeholder-no-fix" ng-model="user.email" type="email" autocomplete="off" placeholder="Email" name="email" required/> </div>
                                        <div class="form-group">
                                            <label class="control-label visible-ie8 visible-ie9">Password</label>
                                            <input class="form-control form-control-solid placeholder-no-fix" ng-model="user.password" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn green uppercase">Login</button>
                                            <label class="rememberme check">
                                                <input type="checkbox" name="remember" value="1" />Remember </label>
                                            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                        </div>
                                        <div class="login-options">
                                            <h4>Or login with</h4>
                                            <ul class="social-icons">
                                                <li>
                                                    <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                                                </li>
                                                <li>
                                                    <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                                                </li>
                                                <li>
                                                    <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                                                </li>
                                                <li>
                                                    <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="create-account">
                                            <p>
                                                <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
                                            </p>
                                        </div>
                                    </form>
                                    <!-- END LOGIN FORM -->
                                    <!-- BEGIN FORGOT PASSWORD FORM -->
                                    <form class="forget-form"   ng-submit="forgetForm(user)" method="post">
                                        <h3 class="font-green">Forget Password ?</h3>
                                        <p> Enter your e-mail address below to reset your password. </p>

                                        <div class="form-group">
                                            <input class="form-control placeholder-no-fix" type="email" ng-model="user.email" autocomplete="off" placeholder="Email" name="email" required/> </div>
                                        <div class="form-actions">
                                            <button type="button" id="back-btn" class="btn btn-default">Back</button>
                                            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                                        </div>
                                    </form>
                                    <!-- END FORGOT PASSWORD FORM -->
                                    <!-- BEGIN REGISTRATION FORM -->
                                    <form class="register-form" novalidate ng-submit="registeForm(user)" method="post">
                                        <h3 class="font-green">Sign Up</h3>
                                        <div class="form-group">
                                            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                                            <input class="form-control placeholder-no-fix" type="text" ng-model="user.fullname" placeholder="Full Name" name="fullname" /> </div>
                                        <div class="form-group">
                                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                            <label class="control-label visible-ie8 visible-ie9">Email</label>
                                            <input class="form-control placeholder-no-fix" type="email" ng-model="user.email" placeholder="Email" name="email" /> </div>
                                        <div class="form-group">
                                            <label class="control-label visible-ie8 visible-ie9">Address</label>
                                            <input class="form-control placeholder-no-fix" type="text" ng-model="user.address" placeholder="Address" name="address" /> </div>
                                        <div class="form-group">
                                            <label class="control-label visible-ie8 visible-ie9">Password</label>
                                            <input class="form-control placeholder-no-fix" type="password" ng-model="user.password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
                                        <div class="form-group">
                                            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                                            <input class="form-control placeholder-no-fix" type="password" ng-model="user.cpassword" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>

                                        <div class="form-actions">
                                            <button type="button" id="register-back-btn" class="btn btn-default">Back</button>
                                            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
                                        </div>
                                    </form>
                                    <!-- END REGISTRATION FORM -->
                                </div>

                            </div>
                        </div>
                        <!-- end login -->
                        <button type="button" class="btn blue btn-lg" ng-show="requestQuotationBtn" ng-click="requestQuotation()">Request Quotation</button>
                    </div>
                </div>
                <!-- start shoping cart-->
                <div class="col-lg-4 shoping-cart">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div ng-show="showPriceTotal">
                                        <span class="price-title"> Your total price</span><br>
                                        <strong class="price">$<% cartPrice %></strong>
                                    </div>
                                    <div ng-show="!showPriceTotal">
                                        <span class="price-title">An instant quote is unavailable</span><br>
                                        <strong class="price" style="font-size: 18px">Request a quote and we will get back to you within 24 hours.</strong>
                                    </div>
                                </div>
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">-->
                                <!--<p>Please select a service </p>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="portlet-body">
                            <h3 style="margin-top: 0"><strong>Summary</strong></h3>
                            <h3 style="margin-top: 0"><strong>Time : <% totalServicesTime %></strong></h3>
                            <!--<a href="">78766 - Austin, TX</a><br>-->
                            <!--<a href="">2016 Honda Civic L4-1.5L Turbo</a>-->
                            <a ng-click="shopCartselectedCarName()"><% shoppingCartselectedCarName %></a>
                            <div ng-if="shoppingCartselectedServiceList.length > 0">
                                <hr>
                                <strong>Services</strong>
                                <!-- -->
                                <!--<div class="md-checkbox-list">-->
                                <div class="list-group">

                                    <a href="javascript:;" class="list-group-item" ng-repeat="obj in shoppingCartselectedServiceList">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="checkbox_s_<% $index %>" class="md-check" ng-model="obj.isSelected" checked="true" ng-change="checkBoxService(obj)">
                                            <label for="checkbox_s_<% $index %>">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <% obj.name %></label>

                                        </div>
                                        <button class="btn btn-circle btn-icon-only btn-default pull-right" ng-click="RemoveService(obj)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div ng-if="shoppingCartselectedOptionalServiceList.length > 0">
                                <hr>
                                <strong>Optional services</strong>
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item" ng-repeat="obj in shoppingCartselectedOptionalServiceList">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="checkbox_os_<% $index %>" class="md-check" ng-model="obj.isSelected" checked="true" ng-change="checkBoxOptionalService(obj)">
                                            <label for="checkbox_os_<% $index %>">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <% obj.name %> </label>
                                        </div>
                                        <button class="btn btn-circle btn-icon-only btn-default pull-right" ng-click="RemoveOptionalService(obj)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- footer-->
                        <div class="footer">
                            <a href="">How YourMechanic works <i class="fa fa-chevron-right"></i></a>
                            <a href="">Our 12-month, 12,000-mile warranty <i class="fa fa-chevron-right "></i></a>
                            <a href="">Frequently Asked Questions <i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!-- end footer-->
                    </div>
                </div>
                <!-- end shoping cart-->

            </div>
            <!-- start select our services-->

            <!--full model -->
            <div class="modal fade" id="full" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h3><stromg>What does Change Oil and Filter entail</stromg></h3>
                            <p>
                                Engine oil is the lifeblood of the engine. The oil resides in the oil pan,
                                which is under the car attached to the bottom of the engine.
                                All internal (moving) parts of the engine need to be lubricated by the engine oil.
                                Inadequate lubrication will cause the parts to wear out faster and eventually lead to engine failure.
                                An oil filter keeps the oil clean and free of debris. If the filter is not replaced on a regular basis,
                                it will get clogged and will not be able to pass oil into the engine.
                            </p>
                            <h3><stromg>Keep in mind</stromg></h3>
                            <ul>
                                <li>When the oil is changed you should always replace the oil filter.</li>
                                <li>When the oil is changed you should always replace the oil filter.</li>
                                <li>When the oil is changed you should always replace the oil filter.</li>
                                <li>When the oil is changed you should always replace the oil filter.</li>
                                <li>When the oil is changed you should always replace the oil filter.</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <button type="button" class="btn grey-salsa btn-outline btn-circle btn-lg">ADD JOB</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </div>
            <!-- end full model-->
        </div>



    </div>
    <!-- END CONTENT BODY -->
</div>

<!--[if lt IE 9]>

<script src="/admin/global/plugins/respond.min.js"></script>

<script src="/admin/global/plugins/excanvas.min.js"></script>

<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/admin/global/plugins/jquery.min.js" type=
"text/javascript">
</script>
<script src="/admin/global/plugins/bootstrap/js/bootstrap.min.js" type=
"text/javascript">
</script>
<script src=
        "/admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript">
</script>
<script src=
        "/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type=
        "text/javascript">
</script>
<script src="/admin/global/plugins/jquery.blockui.min.js" type=
"text/javascript">
</script>
<script src="/admin/global/plugins/uniform/jquery.uniform.min.js" type=
"text/javascript">
</script>
<script src=
        "/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript">
</script> <!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="/admin/global/plugins/select2/js/select2.full.min.js" type=
"text/javascript">
</script>
<script src=
        "/admin/global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript">
</script>
<script src=
        "/admin/global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript">
</script>
<script src=
        "/admin/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"
        type="text/javascript">
</script> <!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script src="/admin/global/scripts/app.min.js" type="text/javascript">
</script> <!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="/admin/pages/scripts/form-wizard.min.js" type=
"text/javascript">
</script> <!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->

<script src="/admin/layouts/layout2/scripts/layout.min.js" type=
"text/javascript">
</script>
<script src="/admin/layouts/layout2/scripts/demo.min.js" type=
"text/javascript">
</script>
<script src="/admin/layouts/global/scripts/quick-sidebar.min.js" type=
"text/javascript">
</script> <!-- END THEME LAYOUT SCRIPTS -->

<script src="/js/appointment/login.js" type=
"text/javascript">
</script> <!-- END THEME LAYOUT SCRIPTS -->




</body>



</html>