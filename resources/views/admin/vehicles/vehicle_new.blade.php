@extends('admin.layouts.master')
@section('title')
    Dashboard
    @parent
@endsection

@section('styles')
    <meta name="-token" content="{!! csrf_token() !!}"/>
    <style>

    .row{
    margin-left: 0px; margin-right: 0px; ;
    }

    </style>
@endsection



@section('content')

	<div class="page-content">

					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<h3 class="page-title">
                                Make Vehicles
							</h3>
							<ul class="page-breadcrumb breadcrumb">
								<li>
                                    <i class="fa fa-home"></i>
                                    Vehicles
                                    <i class="fa fa-angle-right"></i>
								</li>
								<li>
                                    Make Vehicles
								</li>

							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>

		<div class="row">
            <div class="col-md-12">
                @include('admin.layouts.partials.alert')
			 <div class="portlet box red" >
                <div class="portlet-title">
                    <div class="caption">
                    	<b>Make Vehicles</b>
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->

                    <form method="POST" action="{{ route('admin.vehicle.add') }}">
                    	{{ csrf_field() }}
                                <br>
                        <div class="col-xs-12">
                            <label class="col-xs-1 control-label"><b>Year</b></label>
                            <select name="years[]" class="selectpicker col-xs-10 vehicle_year_select" multiple data-max-options="100">
                                @foreach($years as $year)
                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-12"><h5><b>Add Vehicle to above selected year(s)</b></h5></div>
                        <div class="make_vehicles">
                            <div class="make_veh">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="col-md-12"><label class="control-label">Brand</label></div>
                                        <select name="brand" class="selectpicker" data-live-search="true">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-12"><label class="control-label">Model</label></div>
                                        <select name="model" class="selectpicker" data-live-search="true">
                                            @foreach($models as $model)
                                                <option value="{{$model->id}}">{{$model->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="col-md-12"><label class="control-label">Engine Oil Capacity</label></div>
                                                <input type="text" name="engine_oil" class="form-control" >
                                    </div>

                                    <div class="col-md-3">
                                            <div class="col-md-12"><label class="control-label">Gear Oil Capacity</label></div>
                                                <input type="text" name="gear_oil" class="form-control" >
                                    </div>

                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="col-md-12"><label class="control-label">Power Steering Oil Capacity</label></div>
                                        <input type="text" name="power_steering_oil" class="form-control" >
                                    </div>
                                    <div class="col-md-2">
                                        <div class="trim_wrapper">

                                            <div class="col-md-12"><label class="control-label">Trim(s)</label></div>
                                            <div class="trim_input">
                                                <input type="text" name="trims[]" class="form-control trim_field" >
                                                <br/>
                                            </div>
                                            {{--<div class="trim_input" style="display: none;">
                                                <input type="text" name="trims[]" class="form-control" >
                                                <br/>
                                            </div>--}}

                                        </div>


                                    </div>
                                    <div class="col-md-1">
                                        <div class="col-md-6"><p class="add_trim label label-sm label-success" style="cursor: pointer;">Add Trim</p></div>
                                        <br/>
                                        <br/>
                                        <div class="col-md-6"><p class="remove_trim label label-sm label-success" style="cursor: pointer;">Remove Trim</p></div>

                                    </div>
                                </div>

                            </div>



                        </div>

                        {{--<div class="row"><div class="col-xs-12"><p class="add_make btn green">Add More</p></div></div>--}}
                        <br/>


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
</div>



@endsection


@section('scripts')
    {{--{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js') !!}
--}}
    {!! HTML::script('/admin/global/plugins/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::style('/admin/global/plugins/bootstrap-select/css/bootstrap-select.css') !!}
<script>
    $(document).ready(function(){

/*       $('.add_make').click(function(){

           $( ".make_veh:last" ).clone().appendTo(".make_vehicles");

       });*/

       $('.add_trim').click(function(){
           $( ".trim_input:last" ).clone().appendTo(".trim_wrapper");
           //$( ".trim_input:last").removeattr('value');
           $(".trim_field:last").val("");
       });


       $('.remove_trim').click(function(){
           var count_trim = $( ".trim_input" ).length;
           if(count_trim>1){
               $( ".trim_input:last" ).remove();
           }

       });


    });
</script>
@endsection
