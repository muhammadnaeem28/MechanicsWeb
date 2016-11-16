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

    {{--<link href=
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
    <link href="favicon.ico" rel="shortcut icon"><!-- JS -->--}}
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="/admin/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/admin/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/admin/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/admin/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/admin/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="../favicon.ico" />

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/zhaber/datetimepicker/master/datetimepicker.css" type="text/css" rel="stylesheet">

    <link href="/admin/pages/css/login.min.css" rel="stylesheet" type="text/css" />

    <link href="/css/appointment/my_book.css" rel="stylesheet" type="text/css" />



    <script type="text/javascript" src="/js/fullcalendar/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/js/fullcalendar/moment/min/moment.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.10/angular-ui-router.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script>

    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.0.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.6/ngStorage.min.js"></script>

    <script src="/angular/appointment/app.js"></script>
    <script src="/angular/appointment/MyBookCtrl.js"></script>

</head>

<!-- END HEAD -->



<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md" ng-app="formApp">

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- BEGIN CONTAINER -->

<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div ui-view></div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- -->
<!--[if lt IE 9]>
<script src="/admin/global/plugins/respond.min.js"></script>
<script src="/admin/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/admin/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/admin/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/admin/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/admin/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/admin/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/admin/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="/admin/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
<script src="/admin/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="/angular/appointment/login.js" type="text/javascript"></script>

</body>

</html>
