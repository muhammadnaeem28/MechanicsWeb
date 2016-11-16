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
                                Mechanics{{--<small>Add new MCQ</small>--}}
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Mechanics
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Mechanics list
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
            						<b>Mechanics</b>
            					</div>
                                    <div class="actions">

                                        <div class="portlet-input input-inline">
                                            <div class="input-icon right">
                                                <i class="icon-magnifier"></i>
                                                <form action="{{route('admin.mechanic.search')}}" method="get">
                                                <input type="text" name="keyword" class="form-control input-circle" placeholder="search...">
                                                </form>
                                                </div>

                                        </div>
                                        <div class="portlet-input input-inline">
                                                <a href="{{route('admin.mechanic.index')}}" class="btn btn-sm btn-primary easy-pie-chart-reload">
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
                                    <th> Image </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Phone1 </th>
                                    <th> Phone2 </th>
                                    <th> Email </th>
                                    <th> Address </th>
                                    <th> Status </th>
                                    <th width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = (($current_page_number - 1) * $items_per_page) + 1; ?>

                                @foreach($mechanics as $mechanic)
                                  <tr>
                                      <td>{{ $count++ }}</td>
                                      <td><img src="{{ $mechanic->image_url }}" width="150"/> </td>
                                      <td>{{ $mechanic->fname }}</td>
                                      <td>{{ $mechanic->lname }}</td>
                                      <td>{{ $mechanic->phone1 }}</td>
                                      <td>{{ $mechanic->phone2 }}</td>
                                      <td>{{ $mechanic->email }}</td>
                                      <td>{{ $mechanic->address }}</td>
                                      <td>
                                              <form method="POST" action="{{ route('admin.mechanic.updatestatus') }}">
                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="active" value="{{ $mechanic->active }}">
                                                  <input type="hidden" name="id" value="{{ $mechanic->id }}">
                                                  @if($mechanic->active)
                                                      <button type="submit" class="btn btn-sm btn-primary">Active</button>
                                                  @else
                                                        <button type="submit"  class="btn btn-sm btn-danger">Not Active</button>
                                                  @endif
                                              </form>


                                        </td>
                                        <td>
                                            {{--<form method="POST" style="float:left;" action="{{ route('admin.mechanic.destroy', $mechanic->id ) }}">
                                                {{ csrf_field() }}
                                                {{  method_field('DELETE')  }}

                                                <button type="submit" onclick="return confirm('Are you sure to delete {{ $mechanic->fname }} {{ $mechanic->lname }} ?')" class="btn btn-danger"><span class="icon-trash"></span></button>
                                            </form>--}}
                                            <a class="btn btn-info" href="{{ route('admin.mechanic.edit', $mechanic->id) }}">
                                                <span class="icon-pencil"></span>
                                            </a>

                                        </td>

                                  </tr>

                                @endforeach

                            </tbody>
                        </table>
                            {{--{!! $users->render() !!}--}}
                    </div>
                    {!! $mechanics->appends(Request::only('page'))->render() !!}
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

{{--
@section('custom-scripts')
		<script>
			jQuery(document).ready(function() {
			   Metronic.init(); // init metronic core componets
			   Layout.init(); // init layout
			   QuickSidebar.init() // init quick sidebar
			   Index.init();
			   Index.initDashboardDaterange();
			   Index.initJQVMAP(); // init index page's custom scripts
			   Index.initCalendar(); // init index page's custom scripts
			   Index.initCharts(); // init index page's custom scripts
			   Index.initChat();
			   Index.initMiniCharts();
			   Index.initIntro();
			   Tasks.initDashboardWidget();
			});
		</script>
	@stop--}}
