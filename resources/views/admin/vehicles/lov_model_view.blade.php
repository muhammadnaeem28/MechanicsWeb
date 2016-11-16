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
                    Models{{--<small>Add new MCQ</small>--}}
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        Vehicles
                        <i class="fa fa-angle-right"></i>
                        List of values
                        <i class="fa fa-angle-right"></i>

                    </li>
                    <li>
                        Models List
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
                            <b>Models</b>
                        </div>


                        <div class="actions">
                            <div class="portlet-input input-inline">
                                <div class="input-icon right">
                                    <i class="icon-magnifier"></i>
                                    <form action="{{route('admin.vehicle.lov-model.search')}}" method="get">
                                        <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                    </form>
                                </div>

                            </div>
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.vehicle.lov-model.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-repeat"></i> View All </a>
                            </div>
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.vehicle.lov-model.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-plus"></i> Add New </a>
                            </div>

                        </div>

                    </div>

                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>

                                    <th> # </th>
                                    <th> Name</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($models as $model)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $model->name }}</td>
                                        <td>

                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.vehicle.lov-model.edit', $model->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        {!! $models->appends(Request::only('page'))->render() !!}

                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>



@endsection
