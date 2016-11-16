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
                    Brands{{--<small>Add new MCQ</small>--}}
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
                        Brands List
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
                            <b>Brands</b>
                        </div>
                        <div class="actions">
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.vehicle.lov-brand.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
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
                                    <th> Image</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>

                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td><img src="{{ $brand->image_url }}" width="150"></td>
                                        <td>


                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.vehicle.lov-brand.edit', $brand->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>
                                            <form method="POST" style="float:left;" action="{{ route('admin.vehicle.lov-brand.delete', $brand->id ) }}">
                                                {{ csrf_field() }}
                                                {{  method_field('DELETE')  }}

                                                <button type="submit" onclick="return confirm('Are you sure to delete {{ $brand->name }}?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>



@endsection
