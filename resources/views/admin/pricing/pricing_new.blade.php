@extends('admin.layouts.AngularMaster')
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



                <div class="portlet box red" >
                    <div class="portlet-title">
                        <div class="caption">
                            <b>Make Vehicles</b>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <form method="POST" action="#">
                            <br/>
                            <br/>

                            <div ng-controller="VehicleController">
                                <h2>&nbsp; Vehicle </h2>
                                <select name="" ng-Change="getYears(BrandName)" ng-model="BrandName" ng-options="brand as brand.name for brand in brands track by brand.id">       </select>
                                <select name="" ng-Change="getModels(YearName,BrandName)" ng-model="YearName" ng-options="year as year.name for year in years track by year.id"></select>

                                <select name="" ng-model="ModelName" ng-options="model as model.name for model in models track by model.id"></select>
                            </div>

                            <br/>
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

{!! HTML::script('/app/route.js') !!}
{!! HTML::script('/app/packages/dirPagination.js') !!}
{!! HTML::script('/app/services/myServices.js') !!}
{!! HTML::script('/app/helper/myHelper.js') !!}

{!! HTML::script('/app/services/pricingServices.js') !!}
{!! HTML::script('/app/services/VehicleServices.js') !!}

        <!-- App Controller -->
    <script src="{{ asset('/app/controllers/ItemController.js') }}"></script>
    <script src="{{ asset('/app/controllers/PricingController.js') }}"></script>
    <script src="{{ asset('/app/controllers/VehicleController.js') }}"></script>


@endsection
