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
                    Customers{{--<small>Add new MCQ</small>--}}
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        Customers
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Customers Quotation List
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
                            <b>Service Quotations</b>
                        </div>
                        <div class="actions">

                            <div class="portlet-input input-inline">
                                <div class="input-icon right">
                                    <i class="icon-magnifier"></i>
                                    <form action="{{route('admin.customer-quotation.search')}}" method="get">
                                        <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                    </form>
                                </div>

                            </div>
                            <div class="portlet-input input-inline">
                                <a href="{{route('admin.customer-quotation.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                    <i class="fa fa-repeat"></i> View All </a>
                            </div>
                        </div>
                        {{--<div class="actions">
                            <a href="javascript:;" class="btn btn-sm btn-default easy-pie-chart-reload">
                            <i class="fa fa-repeat"></i> Reload </a>
                        </div>--}}
                    </div>
                    {{--                <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-picture"></i>Users </div>
                                        <div class="tools" style="margin-top: -8px;">
                                        <form method="get" action="asdas" >
                                            <div class="form-inline">
                                                <label>
                                                Search
                                                </label>
                                                    <input class="form-control"  type="search" name="keyword" >
                                            </div>
                                        </form>


                    --}}{{--                        <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>--}}{{--
                                        </div>
                                    </div>--}}
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>

                                    <th> # </th>
                                    <th> Quote No </th>
                                    <th> Customer </th>
                                    <th> Phone </th>
                                    <th> Vehicle </th>
                                    <th> Total services </th>
                                    <th> Created on </th>
                                    <th> Status </th>
                                    <th width="10%"> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($quotations as $quotation)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $quotation->quote_number }}</td>
                                        <td>{{ $quotation->fname }} {{ $quotation->lname }}</td>
                                        <td>{{ $quotation->phone1 }} , {{ $quotation->phone2 }}</td>
                                        <td>{{ $quotation->brand_name }} {{ $quotation->year_name }} {{ $quotation->model_name }}</td>
                                        <td>{{ $quotation->total_services }}</td>
                                        <td>{{ $quotation->created_at }}</td>
                                        <td><b>{{ $quotation->status }}</b></td>

                                        <td>
                                            {{--<form method="POST" style="float:left;" action="{{ route('admin.customer.destroy', $customer->id ) }}">
                                                {{ csrf_field() }}
                                                {{  method_field('DELETE')  }}

                                                <button type="submit" onclick="return confirm('Are you sure to delete {{ $customer->fname }} {{ $customer->lname }} ?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                            </form>--}}
                                        <a class="btn btn-info" href="{{ route('admin.customer-quotation.edit', $quotation->quote_id) }}">
                                            <span class="icon-pencil"></span>
                                        </a>
                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                            {{--{!! $users->render() !!}--}}
                        </div>
                        {!! $quotations->appends(Request::only('page'))->render() !!}
                        {{--{{$users->appends(Request::except('page'))->links()}}--}}
                        {{--{!! $users->render() !!}--}}
                        {{--{!! $users->render() !!}--}}

                        {{--                    {!!  $users->fragment('foo')->render() !!}--}}
                        {{--{!!  $users->appends(['sort' => 'votes'])->render() !!}--}}

                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>



@endsection

