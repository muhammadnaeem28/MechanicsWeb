@extends('users.layouts.customer.master')
@section('title')
    Dashboard
    @parent
    @endsection
    @section('content')

            <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Dashboard
            <small>Honda Civic 2016 Prosmatic</small>
        </h3>


    </div>
    <!-- END CONTENT BODY -->

    {{--@foreach($cars as $car)
        <h1>{{$car->name}}</h1>
    @endforeach
    <h1>NAEEM</h1>--}}
@endsection