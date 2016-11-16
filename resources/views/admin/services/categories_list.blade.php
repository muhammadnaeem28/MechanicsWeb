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
                                Service Categories{{--<small>Add new MCQ</small>--}}
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Service Categories
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Categories List
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
            						<b>Service Categories</b>
            					</div>
                                    <div class="actions">

                                        <div class="portlet-input input-inline">
                                            <div class="input-icon right">
                                                <i class="icon-magnifier"></i>
                                                <form action="{{route('admin.service.categories.search')}}" method="get">
                                                <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                                </form>
                                                </div>

                                        </div>
                                        <div class="portlet-input input-inline">
                                                <a href="{{route('admin.service.categories.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
                                                <i class="fa fa-repeat"></i> View All </a>
                                        </div>
                                        <div class="portlet-input input-inline">
                                            <a href="{{route('admin.service.categories.new')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
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
                                    <th> Description</th>
                                    <th> Status</th>
                                    <th width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($s_categories as $s_category)
                                  <tr>
                                      <td>{{ $count++ }}</td>
                                      <td>{{ $s_category->name }}</td>
                                      <td>{{ $s_category->desc }}</td>
                                      <td>
                                              <form method="POST" action="{{ route('admin.service.categories.updatestatus') }}">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="active" value="{{ $s_category->active }}">
                                                  <input type="hidden" name="id" value="{{ $s_category->id }}">
                                                  @if($s_category->active)
                                                      <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                  @else
                                                        <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                  @endif
                                              </form>


                                        </td>
                                        <td>

                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.categories.edit', $s_category->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>

                                            <form method="POST" style="float:left;" action="{{ route('admin.service.categories.destroy', $s_category->id ) }}">
                                                {{ csrf_field() }}
                                                {{  method_field('DELETE')  }}

                                                <button type="submit" onclick="return confirm('Are you sure to delete {{ $s_category->name }}?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                            </form>

                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.categories.services', $s_category->id) }}">
                                                View Services</span>
                                            </a>

                                        </td>

                                  </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    {!! $s_categories->appends(Request::only('page'))->render() !!}

                </div>
            </div>
            <!-- END CONDENSED TABLE PORTLET-->
        </div>
    </div>
	</div>



@endsection
