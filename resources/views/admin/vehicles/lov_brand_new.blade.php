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
                                Add new Brand
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
                                    <i class="fa fa-home"></i>
                                    Vehicles
                                    <i class="fa fa-angle-right"></i>
                                    List of values
                                    <i class="fa fa-angle-right"></i>
                                    Brands List
                                    <i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Add new brand
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Add new brand</b>
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.vehicle.lov-brand.add') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                                <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" value="{{Input::old('name')}}">
                                    <span>{{ $errors->first('name') }}</span>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Select image to upload</label>
                                <div class="col-md-8">
                                    <input type="file" name="brand_image" id="fileToUpload">
                                    <span>{{ $errors->first('brand_image') }}</span>

                                </div>
                            </div>



                        {{--    <div class="form-group">
                                <label class="col-md-2 control-label">Brand Image</label>
                                <div class="col-md-8">

                                    <div class="btn btn-default image-preview-input" style="background-color:#34495e ; color: #fff;" >
                                        <i class="icon-down-open-3"></i>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/>
                                    </div>

                                </div>
                            </div>

--}}

                        <div class="form-actions fluid">

                            <div class="col-md-offset-5 col-md-6">
                                <button type="submit" class="btn green">Submit</button>
                            </div>

                        </div>
                    </form>
                    <!-- END FORM-->
                </div>

		</div>
	</div>
</div>

@endsection

