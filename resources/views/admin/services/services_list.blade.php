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
                                Services{{--<small>Add new MCQ</small>--}}
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Services
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Services List
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
            						<b>Services</b>
            					</div>
                                    <div class="actions">

                                        <div class="portlet-input input-inline">
                                            <div class="input-icon right">
                                                <i class="icon-magnifier"></i>
                                                <form action="{{route('admin.service.search')}}" method="get">
                                                <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                                </form>
                                                </div>

                                        </div>
                                        <div class="portlet-input input-inline">
                                                <a href="{{route('admin.service.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                                <i class="fa fa-repeat"></i> View All </a>
                                        </div>
                                        <div class="portlet-input input-inline">
                                            <a href="{{route('admin.service.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
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
                                    <th> Image </th>
                                    <th> Name </th>
                                    <th> Description</th>
                                    <th> Category</th>
                                    <th> Status</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($s_category_services as $s_category_service)
                                  <tr>
                                      <td>{{ $count++ }}</td>
                                      <td><img src="{{ $s_category_service->image_url }}" width="150"></td>
                                      <td>{{ $s_category_service->name }}</td>
                                      <td>{{ $s_category_service->desc }}</td>
                                      <td><a href="{{route('admin.service.category.index',$s_category_service->category->id)}}">{{ $s_category_service->category->name }}</a></td>
                                      <td>
                                              <form method="POST" action="{{ route('admin.service.updatestatus') }}">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="active" value="{{ $s_category_service->active }}">
                                                  <input type="hidden" name="id" value="{{ $s_category_service->id }}">
                                                  @if($s_category_service->active)
                                                      <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                  @else
                                                        <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                  @endif
                                              </form>


                                        </td>
                                       <td>

                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.destroy', $s_category_service->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>
                                           <form method="POST" style="float:left;" action="{{ route('admin.service.destroy', $s_category_service->id ) }}">
                                               {{ csrf_field() }}
                                               {{  method_field('DELETE')  }}

                                               <button type="submit" onclick="return confirm('Are you sure to delete {{ $s_category_service->name }}?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                           </form>
                                           <a class="btn btn-sm btn-primary" href="{{ route('admin.service.add-optionals', $s_category_service->id) }}">
                                               Add Optionals
                                           </a>

                                           <a class="btn btn-sm btn-primary" href="{{ route('admin.service.view-optionals', $s_category_service->id) }}">
                                               View Optionals
                                           </a>

                                       </td>

                                  </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    {!! $s_category_services->appends(Request::only('page'))->render() !!}

                </div>
            </div>
            <!-- END CONDENSED TABLE PORTLET-->
        </div>
    </div>
	</div>



@endsection
