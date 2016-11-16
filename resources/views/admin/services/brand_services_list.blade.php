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
                                Service Brands{{--<small>Add new MCQ</small>--}}
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Service Brands
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Brands type
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
            						<b>Brands type</b>
            					</div>
                                    <div class="actions">

                                        <div class="portlet-input input-inline">
                                            <div class="input-icon right">
                                                <i class="icon-magnifier"></i>
                                                <form action="{{route('admin.service-brand-services.search')}}" method="get">
                                                <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                                </form>
                                                </div>

                                        </div>
                                        <div class="portlet-input input-inline">
                                                <a href="{{route('admin.service-brand-services.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                                <i class="fa fa-repeat"></i> View All </a>
                                        </div>
                                        <div class="portlet-input input-inline">
                                            <a href="{{route('admin.service-brand-services.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
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
                                    <th> Name </th>
                                    <th> Price</th>
                                    <th> Description</th>
                                    <th> Brand</th>
                                    <th> Status</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($s_brand_services as $s_brand_service)
                                  <tr>
                                      <td>{{ $count++ }}</td>
                                      <td>{{ $s_brand_service->name }}</td>
                                      <td>{{ $s_brand_service->price}}</td>
                                      <td>{{ $s_brand_service->desc }}</td>
                                      <td>{{ $s_brand_service->brand->name }}</td>
                                      <td>
                                              <form method="POST" action="{{ route('admin.service-brand-services.updatestatus') }}">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="active" value="{{ $s_brand_service->active }}">
                                                  <input type="hidden" name="id" value="{{ $s_brand_service->id }}">
                                                  @if($s_brand_service->active)
                                                      <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                  @else
                                                        <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                  @endif
                                              </form>


                                        </td>
                                       <td>

                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service-brand-services.edit', $s_brand_service->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>

                                       </td>

                                  </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    {!! $s_brand_services->appends(Request::only('page'))->render() !!}

                </div>
            </div>
            <!-- END CONDENSED TABLE PORTLET-->
        </div>
    </div>
	</div>



@endsection
