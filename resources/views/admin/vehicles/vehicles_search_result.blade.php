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
                    Search Results{{--<small>Add new MCQ</small>--}}
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        Vehicles
                        <i class="fa fa-angle-right"></i>
                        Search
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Search Results
                    </li>

                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>


        <div class="row">

            <div class="col-md-12">

                @include('admin.layouts.partials.alert')

                        <!-- BEGIN CONDENSED TABLE PORTLET-->
                <div class="portlet box red">
                    <div class="portlet-title" >
                        <div class="caption">
                            <b>Search Result: </b> {{$car_brand}} {{$car_year}}
                        </div>


                        <div class="actions">
                            <form id="destroy_vehicles" method="POST" action="{{ route('admin.vehicle.destroy_vehicles') }}" style="width: 90px;float: left; margin-right: 3px;">
                                {{ csrf_field() }}
                                <div class="portlet-input input-inline">
                                    <button form="destroy_vehicles" type="submit" class="btn btn-sm btn btn-danger" onclick="return confirm('Are you sure to delete all selected records?')" >
                                        <span class="icon-trash"></span>
                                        Delete All
                                    </button>
                                </div>
                            </form>
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.vehicle.list')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-refresh"></i> View All </a>
                            </div>
                            <div class="portlet-input input-inline">
                                <a href="/administrator/#/vehicle/search" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-search"></i> Search Vehicles </a>
                            </div>
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.vehicle.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-plus"></i> Add New </a>
                            </div>

                        </div>

                    </div>

                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <input form="destroy_vehicles" class="form_select_all_vehicles" type="checkbox" name="checked_vehicles[]" value="0">
                                    </th>
                                    <th> # </th>
                                    <th> Brand</th>
                                    <th> Year</th>
                                    <th> Model</th>
                                    <th> Trim</th>
                                    <th> Engine Oil</th>
                                    <th> Gear Oil</th>
                                    <th> Power Steering Oil</th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td><input class="form_vehicle" form="destroy_vehicles" type="checkbox" name="checked_vehicles[]" value="{{ $vehicle->model_trim_id }}"></td>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $vehicle->brand_name }}</td>
                                        <td>{{ $vehicle->year_name }}</td>
                                        <td>{{ $vehicle->model_name }}</td>
                                        <td>{{ $vehicle->trim_name }}</td>
                                        <td>{{ $vehicle->engine_oil}}</td>
                                        <td>{{ $vehicle->gear_oil }}</td>
                                        <td>{{ $vehicle->power_steering_oil }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.vehicle.updatestatus') }}">
                                                {{ csrf_field() }}
                                                {{--<input type="hidden" name="brand_year_active" value="{{ $vehicle->brand_year_active }}">--}}
                                                <input type="hidden" name="model_trim_active" value="{{ $vehicle->model_trim_active }}">
                                                {{--<input type="hidden" name="brand_year_id" value="{{ $vehicle->brand_year_id }}">--}}
                                                <input type="hidden" name="model_trim_id" value="{{ $vehicle->model_trim_id }}">
                                                @if($vehicle->model_trim_active)
                                                    <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                @else
                                                    <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                @endif
                                            </form>


                                        </td>

                                        <td>
                                            <form method="POST" style="float:left;" action="{{ route('admin.vehicle.destroy_vehicle', $vehicle->model_trim_id ) }}">
                                                {{ csrf_field() }}
                                                {{  method_field('DELETE')  }}

                                                <button type="submit" onclick="return confirm('Are you sure to delete {{ $vehicle->model_name }}?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                            </form>

                                            {{--<a class="btn btn-sm btn-primary" href="{{ route('admin.vehicle.lov-model.edit', $model->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>--}}
                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        {!! $vehicles->appends(Request::only('page'))->render() !!}

                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>



@endsection
@section("scripts")
    <script>
        $( document ).ready(function() {
            $(".form_select_all_vehicles").change(function(){  //"select all" change

                //if($('#checkArray:checkbox:checked').length > 0

                if ($(".form_select_all_vehicles").parent().hasClass( "checked" )){
                    $('.form_vehicle').each(function(){ //iterate all listed checkbox items
                        $(this).parent().addClass("checked");
                    });

                }else{

                    $('.form_vehicle').each(function(){ //iterate all listed checkbox items
                        $(this).parent().removeClass("checked");
                    });
                }

            });
        });

    </script>
@endsection