@extends('admin.layouts.master')
@section('title')
    Dashboard
    @parent
@endsection

@section('content')

	<div class="page-content">

					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<h3 class="page-title">
                                Add Optionals
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Services
									<i class="fa fa-angle-right"></i>
                                    Services List
									<i class="fa fa-angle-right"></i>
                                    {{$s_category_service->name}}
                                    <i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Add Optionals
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Add Optionals:</b> {{ $s_category_service->name }}
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.service.save-optionals', $s_category_service->id) }}" class="form-horizontal">
                    	{{ csrf_field() }}

                                <br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Optional Services</label>
                            <div class="col-md-8">
                                <select class="form-control" name="os_id">
                                    @foreach($optional_services as $optional_service)
                                        <option value="{{$optional_service->id}}">{{$optional_service->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="{{$s_category_service->id}}" name="s_id">
                            </div>
                        </div>

                        <br/>

                        <div class="form-actions fluid">

                            <div class="col-md-offset-5 col-md-6">
                                <button type="submit" class="btn green">Update</button>
                            </div>

                        </div>
                    </form>
                    <!-- END FORM-->
                </div>

		</div>
	</div>
</div>



@endsection
