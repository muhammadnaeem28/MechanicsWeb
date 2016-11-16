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
							Mechanics
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Mechanics
									<i class="fa fa-angle-right"></i>
                                    Mechanics List
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Edit Mechanic
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Edit:</b> {{ $mechanic->fname }} {{ $mechanic->lname }}
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.mechanic.update', $mechanic->id) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                        {{ method_field('PATCH') }}
                                <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <img src="{{ $mechanic->image_url }}" width="150">

                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Select image to upload</label>
                            <div class="col-md-8">
                                <input type="file" name="mechanic_image" id="fileToUpload">
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="col-md-2 control-label">First Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="fname" class="form-control" value="{{ $mechanic->fname }}">
                                    <span>{{ $errors->first('fname') }}</span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="lname" class="form-control" value="{{ $mechanic->lname }}">
                                    <span>{{ $errors->first('lname') }}</span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" class="form-control" value="{{ $mechanic->email }}">
                                     <span>{{ $errors->first('email') }}</span>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Password</label>
                                <div class="col-md-8">
                                    <input value="{{ $mechanic->m_password }}" type="text" class=" form-control" name="password" id="password1" placeholder="Password">
                                    {{ $errors->first('password') }}

                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Confirm password</label>
                                <div class="col-md-8">
                                    <input value="{{ $mechanic->m_password }}" type="text" class=" form-control" name="password_confirmation" id="password2" placeholder="Confirm password">
                                    {{ $errors->first('password_confirmation') }}

                                </div>

                            </div>



                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Phone Number 1</label>
                          <div class="col-md-8">

                          <input id="textinput" value="{{$mechanic->phone1}}" name="phone1" type="text" placeholder="Phone 1" class="form-control input-md">

                            <span>{{ $errors->first('phone1') }}</span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Phone Number 2</label>
                          <div class="col-md-8">

                          <input id="textinput" value="{{$mechanic->phone2}}" name="phone2" type="text" placeholder="Phone 2" class="form-control input-md">

                            <span>{{ $errors->first('phone2') }}</span>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Address</label>
                          <div class="col-md-8">
                          <input id="textinput" value="{{$mechanic->address}}" name="address" type="text" placeholder="Address" class="form-control input-md">
                            <span>{{ $errors->first('address') }}</span>
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
