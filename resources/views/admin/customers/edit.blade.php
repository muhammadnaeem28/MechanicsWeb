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
							Customers
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
									<i class="fa fa-home"></i>
                                    Customers
									<i class="fa fa-angle-right"></i>
                                    Customers List
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Edit Customer
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">

			 <div class="portlet box red col-xs-10 col-xs-offset-1" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Edit:</b> {{ $customer->fname }} {{ $customer->lname }}
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form method="POST" action="{{ route('admin.customer.update', $customer->id) }}" class="form-horizontal">
                    	{{ csrf_field() }}
                        {{ method_field('PATCH') }}
                                <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">First Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="fname" class="form-control" value="{{ $customer->fname }}">
                                    <span>{{ $errors->first('fname') }}</span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="lname" class="form-control" value="{{ $customer->lname }}">
                                    <span>{{ $errors->first('lname') }}</span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" class="form-control" value="{{ $customer->email }}">
                                     <span>{{ $errors->first('email') }}</span>
                                </div>
                            </div>


                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Phone Number 1</label>
                          <div class="col-md-8">

                          <input id="textinput" value="{{$customer->phone1}}" name="phone1" type="text" placeholder="Phone 1" class="form-control input-md">

                            <span>{{ $errors->first('phone1') }}</span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Phone Number 2</label>
                          <div class="col-md-8">

                          <input id="textinput" value="{{$customer->phone12}}" name="phone1" type="text" placeholder="Phone 2" class="form-control input-md">

                            <span>{{ $errors->first('phone2') }}</span>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-2 control-label" for="textinput">Address</label>
                          <div class="col-md-8">
                          <input id="textinput" value="{{$customer->address}}" name="address" type="text" placeholder="Address" class="form-control input-md">
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
