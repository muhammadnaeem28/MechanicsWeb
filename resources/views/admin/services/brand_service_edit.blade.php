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
                                Services
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Services
									<i class="fa fa-angle-right"></i>
                                    Brand Services List
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Edit Brand Service
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Edit:</b> {{ $s_brand_service->name }}
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.service-brand-services.update', $s_brand_service->id) }}" class="form-horizontal">
                    	{{ csrf_field() }}
                        {{ method_field('PATCH') }}
                                <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" value="{{ $s_brand_service->name }}">
                                    <span>{{ $errors->first('name') }}</span>

                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Brand</label>
                            <div class="col-md-8">
                                <select class="form-control" name="s_brand_id">
                                    @foreach($s_brands as $s_brand)
                                        @if($s_brand_service->s_brand_id == $s_brand->id)
                                            <option selected value="{{$s_brand->id}}">{{$s_brand->name}}</option>
                                        @else
                                            <option value="{{$s_brand->id}}">{{$s_brand->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-8">
                                    <input type="text" name="price" class="form-control" value="{{ $s_brand_service->price }}">
                                    <span>{{ $errors->first('price') }}</span>

                                </div>
                            </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="textarea">Description</label>
                            <div class="col-md-8">
                            <textarea rows="12" col="9" class="form-control" id="textarea" name="desc"
                                      placeholder="">{{$s_brand_service->desc}}</textarea>
                            </div>
                        </div>

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
