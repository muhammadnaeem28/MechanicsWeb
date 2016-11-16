<html lang="en">

<head>

    <title>CRUD</title>

    <!-- Fonts -->

    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>



    {{--<!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">



    <!-- Optional theme -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">



    <!-- Latest compiled and minified JavaScript -->

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    --}}

    <!-- Angular JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

    <!-- MY App -->



    {!! HTML::script('/Angular/route.js') !!}

    {!! HTML::script('/Angular/packages/dirPagination.js') !!}

    {!! HTML::script('/Angular/services/myServices.js') !!}

    {!! HTML::script('/Angular/helper/myHelper.js') !!}

            <!-- App Controller -->

    <script src="{{ asset('/Angular/controllers/ItemController.js') }}"></script>

</head>

<body ng-app="main-App">

<nav class="navbar navbar-default">

    <div class="container-fluid">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                <span class="sr-only">Toggle Navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="#">Laravel</a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">

                <li><a href="/#/">Home</a></li>

                <li><a href="/#/items">Item</a></li>

            </ul>

        </div>

    </div>

</nav>

<div class="container">

    <ng-view></ng-view>

</div>

</body>

</html>