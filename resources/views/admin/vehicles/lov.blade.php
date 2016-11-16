@extends('admin.layouts.master')
@section('title')
    Dashboard
    @parent
    @endsection
    @section('content')

            <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    List of Values{{--<small>Add new MCQ</small>--}}
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        Vehicles
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        List of Values
                    </li>

                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

        <div class="row">

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12" >
                <a href="{{route('admin.vehicle.lov-year.index')}}">
                <div class="dashboard-stat2 bordered" style="padding-bottom: 0px;">
                    <div class="display">
                        <div class="number" style="width: 50%;">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$years}}">{{$years}}</span>

                            </h3>
                            <small>Vehicle Years</small>
                        </div>
                        <div class="icon">
                            <i class="icon-magnifier"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>


            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12" >
                <a href="{{route('admin.vehicle.lov-brand.index')}}">
                    <div class="dashboard-stat2 bordered" style="padding-bottom: 0px;">
                        <div class="display">
                            <div class="number" style="width: 50%;">
                                <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="{{$brands}}">{{$brands}}</span>

                                </h3>
                                <small>Vehicle Brands</small>
                            </div>
                            <div class="icon">
                                <i class="icon-magnifier"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12" >
                <a href="{{route('admin.vehicle.lov-model.index')}}">
                    <div class="dashboard-stat2 bordered" style="padding-bottom: 0px;">
                        <div class="display">
                            <div class="number" style="width: 50%;">
                                <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="{{$models}}">{{$models}}</span>

                                </h3>
                                <small>Vehicle Models</small>
                            </div>
                            <div class="icon">
                                <i class="icon-magnifier"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>



@endsection
