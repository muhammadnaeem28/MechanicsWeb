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
                    Edit Brand
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
                        Edit Brand
                    </li>

                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Edit:</b> {{ $brand->name }}
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.vehicle.lov-brand.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    	{{ csrf_field() }}

                                <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
                                    <input type="hidden" name="id"  value="{{ $brand->id }}">
                                    <span>{{ $errors->first('name') }}</span>

                                </div>
                            </div>
                        <br>
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-8">

                                <img src="{{ $brand->image_url }}" width="150">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Select image to upload</label>
                            <div class="col-md-8">
                                <input type="file" name="brand_image" id="fileToUpload">
                                <span>{{ $errors->first('brand_image') }}</span>

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
