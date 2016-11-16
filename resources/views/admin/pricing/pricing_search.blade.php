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
                    Search Result
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        Pricing
                        <i class="fa fa-angle-right"></i>
                        Search
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Search Result
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
                            <b>Search: </b>{{$car_brand}}, {{$car_model}} {{$car_year}}
                        </div>
                        <div class="actions">
                            <div class="portlet-input input-inline">
                                <a href="{{route("admin.pricing.view")}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-refresh"></i> View All</a>
                            </div>
                            <div class="portlet-input input-inline">
                                <a href="/administrator/#/Pricing/search" class="btn btn-sm btn-primary">
                                    <i class="fa fa-search"></i> Search Pricing</a>
                            </div>
                            <div class="portlet-input input-inline">
                                <a href="/administrator/#/Pricing/new" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add Pricing </a>
                            </div>
                        </div>

                    </div>

                    <div class="portlet-body flip-scroll">
                        <div class="table table-bordered table-striped table-condensed flip-content">
                            <table class="table table-condensed table-hover">
                                <thead class="flip-content">
                                <tr>

                                    <th> # </th>
                                    <th> Brand</th>
                                    <th> Year</th>
                                    <th> Model</th>
                                    {{--<th> Trim</th>--}}
                                    <th style="border-bottom: 1px solid #3598dc; border-left:1px solid #3598dc ">
                                        Service
                                    </th>
                                    <th style="border-bottom: 1px solid #2bb8c4;">
                                        Service Brand
                                    </th>
                                    <th style="border-bottom: 1px solid #3598dc;"> Price</th>
                                    <th style="border-bottom: 1px solid #8E44AD; border-left : 1px solid #8E44AD;">
                                        Optional Service
                                    </th>
                                    <th style="border-bottom: 1px solid #8E44AD;"> Price</th>
                                    <th> Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($prices as $price)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $price->brand_name }}</td>
                                        <td>{{ $price->year_name }}</td>
                                        <td>{{ $price->model_name }}</td>
                                        {{--<td>{{ $price->trim_name }}</td>--}}
                                        <td>{{ $price->s_name}}</td>
                                        <td>{{ $price->sb_name}}</td>
                                        @if($price->s_price_default==1)
                                            <td><i>Default</i></td>
                                        @else

                                            @if($price->s_price=="")
                                                <td>{{ $price->s_price}}</td>
                                            @else
                                                <td>Rs. {{ $price->s_price}}</td>
                                            @endif
                                        @endif


                                        <td>{{ $price->os_name}}</td>
                                        @if($price->os_price_default==1 )
                                            <td><i>Default</i></td>
                                        @else
                                            @if($price->os_price=="")
                                                <td>{{ $price->os_price}}</td>
                                            @else
                                            <td>Rs. {{ $price->os_price}}</td>
                                            @endif
                                        @endif


                                        <td>
                                            <form method="POST" action="{{ route('admin.pricing.updatestatus') }}">
                                                {{ csrf_field() }}
                                                {{--<input type="hidden" name="brand_year_active" value="{{ $vehicle->brand_year_active }}">--}}
                                                <input type="hidden" name="pricing_active" value="{{ $price->pricing_active }}">
                                                {{--<input type="hidden" name="brand_year_id" value="{{ $vehicle->brand_year_id }}">--}}
                                                <input type="hidden" name="pricing_id" value="{{ $price->pricing_id }}">
                                                @if($price->pricing_active)
                                                    <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                @else
                                                    <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                @endif
                                            </form>


                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        {!! $prices->appends(Request::only('page'))->render() !!}

                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>



@endsection
