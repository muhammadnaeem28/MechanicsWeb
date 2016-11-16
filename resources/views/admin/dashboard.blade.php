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

                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs">September 30, 2016 - October 29, 2016</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Dashboard
                <small>dashboard & statistics</small>
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-purple-soft"></i>
                                <span class="caption-subject font-purple-soft bold uppercase">Appointments</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a href="#tab_1_assigned" data-toggle="tab" aria-expanded="false"> Assigned </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_unassigned" data-toggle="tab" aria-expanded="false"> Unassigned </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_complete" data-toggle="tab" aria-expanded="false"> Complete </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab_1_assigned">
                                @if(isset($assigned) AND $assigned>0)
                                        <table class="table table-striped">
	                                        <thead>
	                                          <tr>
	                                            <th>Customer</th>
	                                            <th>Mechanic</th>
	                                            <th>Car</th>
	                                            <th>Appointment No.</th>
	                                            <th>Status</th>
	                                            <th>Price</th>
	                                          </tr>
	                                        </thead>
	                                        <tbody>
	                                        
	                                        @foreach($appointments as $assigned)
	                                        @if($assigned->status_id == 3)
	                                          <tr>
	                                            <th>{{$assigned->customer_fname}} {{$assigned->customer_lname}}</th>
	                                            <th>{{$assigned->mechanic_fname}} {{$assigned->mechanic_lname}}</th>
	                                            <th>{{$assigned->car_model}}</th>
	                                            <th>{{$assigned->appointment_no}}</th>
	                                            <th>{{$assigned->status_name}}</th>
	                                            <th>{{$assigned->total_price}}</th>
	                                          </tr>
	                                        @endif
                                          	@endforeach
                                          	
	                                        </tbody>
	                                    </table>
	                                    @else
                                      	<div class="alert alert-info">
										  <strong>Info!</strong> There is no data behind assigned appointments.
										</div>
                                      	@endif
                                </div>
                                <div class="tab-pane fade" id="tab_1_unassigned">
                                @if(isset($unassigned) AND $unassigned>0)
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
	                                            <th>Customer</th>
	                                            <th>Mechanic</th>
	                                            <th>Car</th>
	                                            <th>Appointment No.</th>
	                                            <th>Status</th>
	                                            <th>Price</th>
	                                          </tr>
                                            </thead>
                                            <tbody>
                                              
		                                        @foreach($appointments as $unassigned)
		                                        @if($unassigned->status_id == 1)
		                                          <tr>
		                                            <th>{{$unassigned->customer_fname}} {{$unassigned->customer_lname}}</th>
		                                            <th>{{$unassigned->mechanic_fname}} {{$unassigned->mechanic_lname}}</th>
		                                            <th>{{$unassigned->car_model}}</th>
		                                            <th>{{$unassigned->appointment_no}}</th>
		                                            <th>{{$unassigned->status_name}}</th>
		                                            <th>{{$unassigned->total_price}}</th>
		                                          </tr>
		                                        @endif
	                                          	@endforeach
	                                          	
                                            </tbody>
                                        </table>
                                        @else
                                      	<div class="alert alert-info">
										  <strong>Info!</strong> There is no data behind un-assigned appointments.
										</div>
                                      	@endif
                                </div>
                                <div class="tab-pane fade" id="tab_1_complete">
                                @if(isset($completed) AND $completed>0)
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Customer</th>
                                            <th>Mechanic</th>
                                            <th>Car</th>
                                            <th>Appointment No.</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          
	                                        @foreach($appointments as $complete)
	                                        @if($complete->status_id == 6)
	                                          <tr>
	                                            <th>{{$complete->customer_fname}} {{$complete->customer_lname}}</th>
	                                            <th>{{$complete->mechanic_fname}} {{$complete->mechanic_lname}}</th>
	                                            <th>{{$complete->car_model}}</th>
	                                            <th>{{$complete->appointment_no}}</th>
	                                            <th>{{$complete->status_name}}</th>
	                                            <th>{{$complete->total_price}}</th>
	                                          </tr>
	                                        @endif
                                          	@endforeach
	                                          	
                                        </tbody>
                                    </table>
                                    @else
                                  	<div class="alert alert-info">
									  <strong>Info!</strong> There is no data behind completed appointments.
									</div>
                                  	@endif
                                </div>
                            </div>



                        </div>
                    </div>


                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-purple-soft"></i>
                                <span class="caption-subject font-purple-soft bold uppercase">Quotations</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a href="#tab_1_1" data-toggle="tab" aria-expanded="false"> Requested </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false"> Bookable </a>
                                </li>
                                <li class="dropdown active">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> dropdown
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="#tab_1_3" tabindex="-1" data-toggle="tab" aria-expanded="false"> Option 1 </a>
                                        </li>
                                        <li class="active">
                                            <a href="#tab_1_4" tabindex="-1" data-toggle="tab" aria-expanded="true"> Option 2 </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" tabindex="-1" data-toggle="tab" aria-expanded="false"> Option 3 </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" tabindex="-1" data-toggle="tab" aria-expanded="false"> Option 4 </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab_1_1">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>Mary</td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>July</td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                                <div class="tab-pane fade" id="tab_1_2">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>Mary</td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>July</td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                                <div class="tab-pane fade" id="tab_1_3">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>Mary</td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>July</td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                                <div class="tab-pane fade active in" id="tab_1_4">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>Mary</td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                          </tr>
                                          <tr>
                                            <td>July</td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>



            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->


        </div>
        <!-- END CONTENT BODY -->

    {{--@foreach($cars as $car)
        <h1>{{$car->name}}</h1>
    @endforeach
    <h1>NAEEM</h1>--}}
@endsection