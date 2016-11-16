<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 7/8/2016
 * Time: 3:31 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles\CSPricing;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\CategoryServices;
use App\Models\ServiceBrands;
use App\Models\BrandServices;
use App\Models\OptionalServices;
use DB;
use App\Models\Vehicles\CarModelTrim;
use App\Models\Vehicles\CarModel;
use App\Models\CSPrcing;
use App\Models\Vehicles\BrandYear;
use App\Models\Vehicles\CarBrand;
use Alert;
use Image;
use Auth;
use App\Http\Requests;
use Validator;

class PricingControllerAdmin extends Controller
{
    protected $s_category;
    protected $s_category_services;
    protected $s_brands;
    protected $s_brand_services;
    protected $optional_services;
    /**
     * create a new instance
     */
    public function __construct()
    {
        $this->s_category = new ServiceCategory();
        $this->s_category_services = new CategoryServices();
        $this->s_brand = new ServiceBrands();
        $this->s_brand_services = new BrandServices();
        $this->optional_services = new OptionalServices();
    }

    public function IndexServiceCategories()
    {
        $categories = ServiceCategory::all();
        return response($categories);
    }


    public function IndexCategoryServices($s_category_id)
    {

        $result = ServiceCategory::find($s_category_id);
        $results = $result->services;
        return response($results);
    }

    public function IndexServiceOptionals($s_id)
    {
        $result = CategoryServices::find($s_id);
        $results = $result->optionals;
        return response($results);
    }

    public function IndexServiceBrands($s_id)
    {
        $results = ServiceBrands::where('s_id',$s_id)->get();
        return response($results);
    }

    public function IndexServiceBrandTypes($s_brand_id)
    {
        $result = ServiceBrands::find($s_brand_id);
        $results = $result->services;
        return $results;
    }


    public function IndexVehicleBrands(){
        $results = CarBrand::where("active","1")->get();

        return response($results);
    }

    public function IndexBrandYears($brand_id){

        $result = CarBrand::find($brand_id);
        $results = $result->years;
        return response($results);
    }

    public function IndexVehicleModels($brand_id,$year_id){
        $results = CarModelTrim::where('year_id',$year_id)->where('brand_id',$brand_id)->where("active","1")->groupBy('name')->get();

        return response($results);
    }



    //
    public function AddPricing(Request $request){




        //return $request->input();
        //Here we will



        $s_category_service = $request->input('s_category_service');
        $s_name  = $request->input('s_name');
        $s_price = ltrim($request->input('s_price'));
        $s_price_default = $request->input('s_price_default');


        $s_brands_exist = $request->input('s_brands_exist');

        if($s_brands_exist=="11"){
            $s_brand = $request->input('s_brand');
            $service_brand = ServiceBrands::find($s_brand);
            $service_brand_name = $service_brand->name;
            $service_brand_id = $service_brand->id;
        }else{


            $service_brand_name = null;
            $service_brand_id = null;
        }

        //$s_hours = $request->input('s_hours');
        //$s_mints = $request->input('s_mints');
        //$brand_service_prices  = $request->input('brand_service_prices');
        //$brand_service_names  = $request->input('brand_service_names');
        //$brand_service_ids  = $request->input('brand_service_ids');
        //$brand_service_default = $request->input('brand_service_default');

        $s_optional_prices = $request->input('s_optional_prices');
        $s_optional_names = $request->input('s_optional_names');
        $s_optional_ids = $request->input('s_optional_ids');
        $s_optional_default = $request->input('s_optional_default');

        //$s_optional_hours = $request->input('s_optional_hours');
        //$s_optional_mints = $request->input('s_optional_mints');

        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');
        $c_year = $request->input('c_year');
        $car_year = $request->input('car_year');
        /*$car_model = $request->input('car_model');*/
        $c_models = $request->input('c_models');

        if(!$s_category_service){
            alert()->error('Sorry, Please select service', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }
        if(!$c_models){
            alert()->error('Sorry, Please select at least one vehicle model', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }



        //  $bs_length =  sizeof($brand_service_ids);
        $os_length =  sizeof($s_optional_ids);

        //$bs_default_length =  sizeof($brand_service_default);
        $os_default_length =  sizeof($s_optional_default);

        //Inserting pricing values
        // if(true){
        if($os_length>0 || $os_default_length>0){

            $loop_size = max($os_length,$os_default_length);

            for($i=0;$i<$loop_size;$i++) {

                foreach($c_models as $c_model){


                    $car_model = CarModelTrim::find($c_model);
                    $model_name = $car_model->name;



                    if($os_length > $i){ //############################ optional Service prices input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->car_model = $model_name;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                        $CSPricing->sb_id = $service_brand_id;
                        $CSPricing->sb_name = $service_brand_name;


                        if($s_price){

                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }

                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }

                        $CSPricing->os_id= $s_optional_ids[$i];
                        $To_os_id= $s_optional_ids[$i];

                        if(ltrim($s_optional_prices[$i])==""){
                            $CSPricing->os_price_default = 1;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= "";

                            $To_os_price_default  = 1;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = "";
                        }else{
                            $CSPricing->os_price_default = 0;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= ltrim($s_optional_prices[$i]);


                            $To_os_price_default  = 0;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = $s_optional_prices[$i];
                        }

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('sb_id',$service_brand_id)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){
                            $CSPricing->save();   }
                        else{

                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->car_model = $model_name;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->sb_id = $service_brand_id;
                            $pricing->sb_name = $service_brand_name;

                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;

                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->active = 1;
                            $pricing->save();
                        }
                    }
                    if($os_default_length > $i){ //################ Brand service's default checkbox input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->car_model = $model_name;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                        $CSPricing->sb_id = $service_brand_id;
                        $CSPricing->sb_name = $service_brand_name;


                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }

                        $CSPricing->os_price_default = 1;
                        $CSPricing->os_id= $s_optional_default[$i];
                        $CSPricing->os_name= $s_optional_names[$i];
                        $CSPricing->os_price= "";



                        $To_os_price_default  = 1;
                        $To_os_id= $s_optional_default[$i];
                        $To_os_name = $s_optional_names[$i];
                        $To_os_price = "";

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('sb_id',$service_brand_id)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){   $CSPricing->save();   }
                        else{

                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->car_model = $model_name;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->sb_id = $service_brand_id;
                            $pricing->sb_name = $service_brand_name;

                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;


                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->active = 1;
                            $pricing->save();
                        }

                    }

                }//END For Loop of car models
            }
        }
        else {
            //Service brand and optional service selected, only service is there
            foreach($c_models as $c_model){

                $car_model = CarModelTrim::find($c_model);
                $model_name = $car_model->name;

                $CSPricing = new CSPricing();
                $CSPricing->cb_id = $c_brand;
                $CSPricing->car_brand = $car_brand;
                $CSPricing->cy_id = $c_year;
                $CSPricing->car_year = $car_year;
                $CSPricing->cm_id = $c_model;
                $CSPricing->car_model = $model_name;
                $CSPricing->s_id = $s_category_service;
                $CSPricing->s_name = $s_name;
                $CSPricing->sb_id = $service_brand_id;
                $CSPricing->sb_name = $service_brand_name;

                // check if price for service came empty or if exist
                if($s_price){
                    if($s_price =="")
                    {
                        $CSPricing->s_price_default = 1;
                        $CSPricing->s_price = "";
                        $To_s_price = "";
                        $To_s_price_default  = 1;
                    }else {
                        $CSPricing->s_price = $s_price;
                        $CSPricing->s_price_default = 0;
                        $To_s_price = $s_price;
                        $To_s_price_default  = 0;
                    }
                } else{
                    //default was checked
                    $CSPricing->s_price_default = 1;
                    $CSPricing->s_price = "";
                    $To_s_price = "";
                    $To_s_price_default  = 1;
                }

                //check if pricing for same variables already there

                $pricing = CSPricing::where('cb_id',$c_brand)
                    ->where('cy_id',$c_year)
                    ->where('cm_id',$c_model)
                    ->where('s_id',$s_category_service)
                    ->first();
                if(is_null($pricing)){
                    $CSPricing->save();
                }
                else{
                    $pricing->cb_id = $c_brand;
                    $pricing->car_brand = $car_brand;
                    $pricing->cy_id = $c_year;
                    $pricing->car_year = $car_year;
                    $pricing->cm_id = $c_model;
                    $CSPricing->car_model = $model_name;
                    $pricing->s_id = $s_category_service;
                    $pricing->s_name = $s_name;

                    $pricing->s_price_default = $To_s_price_default;
                    $pricing->s_price = $To_s_price;

                    $pricing->active = 1;
                    $pricing->save();

                }
            }
        }
        /*        if(!$s_category_service){
                    $prices = CSPricing::where('cb_id',$c_brand)
                        ->where('cy_id',$c_year)
                        ->where('cm_id',$c_model)
                        ->where('s_id',$s_category_service)
                        ->get();

                    foreach($prices as $price){
                        $price->s_price_default = $To_s_price_default;
                        $price->s_price = $To_s_price;
                        $price->s_hours = $s_hours;
                        $price->s_mints = $s_mints;
                        $price->active = 1;
                        $price->save();
                    }
                }*/

        return redirect()->route("admin.pricing.view")->with('successMessage', 'Added pricing successfully.');
        //return redirect()->back()->with('errorMessage', 'Failed update status');
    }
    public function Old2_AddPricing(Request $request){




        //return $request->input();
        //Here we will



        $s_category_service = $request->input('s_category_service');
        $s_name  = $request->input('s_name');
        $s_price = ltrim($request->input('s_price'));
        $s_price_default = $request->input('s_price_default');


        $s_brands_exist = $request->input('s_brands_exist');

        if($s_brands_exist=="11"){
            $s_brand = $request->input('s_brand');
            $service_brand = ServiceBrands::find($s_brand);
            $service_brand_name = $service_brand->name;
            $service_brand_id = $service_brand->id;
        }else{


            $service_brand_name = null;
            $service_brand_id = null;
        }

        //$s_hours = $request->input('s_hours');
        //$s_mints = $request->input('s_mints');
        //$brand_service_prices  = $request->input('brand_service_prices');
        //$brand_service_names  = $request->input('brand_service_names');
        //$brand_service_ids  = $request->input('brand_service_ids');
        //$brand_service_default = $request->input('brand_service_default');

        $s_optional_prices = $request->input('s_optional_prices');
        $s_optional_names = $request->input('s_optional_names');
        $s_optional_ids = $request->input('s_optional_ids');
        $s_optional_default = $request->input('s_optional_default');

        //$s_optional_hours = $request->input('s_optional_hours');
        //$s_optional_mints = $request->input('s_optional_mints');

        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');
        $c_year = $request->input('c_year');
        $car_year = $request->input('car_year');
        /*$car_model = $request->input('car_model');*/
        $c_models = $request->input('c_models');

        if(!$s_category_service){
            alert()->error('Sorry, Please select service', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }
        if(!$c_models){
            alert()->error('Sorry, Please select at least one vehicle model', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }



      //  $bs_length =  sizeof($brand_service_ids);
        $os_length =  sizeof($s_optional_ids);

        //$bs_default_length =  sizeof($brand_service_default);
        $os_default_length =  sizeof($s_optional_default);

        //Inserting pricing values
       // if(true){
       if($os_length>0 || $os_default_length>0){

            $loop_size = max($os_length,$os_default_length);

            for($i=0;$i<$loop_size;$i++) {

                foreach($c_models as $c_model){


                    $car_model = CarModelTrim::find($c_model);
                    $model_name = $car_model->name;



                    if($os_length > $i){ //############################ optional Service prices input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->car_model = $model_name;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                        $CSPricing->sb_id = $service_brand_id;
                        $CSPricing->sb_name = $service_brand_name;


                        if($s_price){

                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }

                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }

                        $CSPricing->os_id= $s_optional_ids[$i];
                        $To_os_id= $s_optional_ids[$i];

                        if(ltrim($s_optional_prices[$i])==""){
                            $CSPricing->os_price_default = 1;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= "";

                            $To_os_price_default  = 1;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = "";
                        }else{
                            $CSPricing->os_price_default = 0;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= ltrim($s_optional_prices[$i]);


                            $To_os_price_default  = 0;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = $s_optional_prices[$i];
                        }

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){
                            $CSPricing->save();   }
                        else{

                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->car_model = $model_name;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->sb_id = $service_brand_id;
                            $pricing->sb_name = $service_brand_name;

                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;

                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->active = 1;
                            $pricing->save();
                        }
                    }
                    if($os_default_length > $i){ //################ Brand service's default checkbox input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->car_model = $model_name;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                            $CSPricing->sb_id = $service_brand_id;
                        $CSPricing->sb_name = $service_brand_name;


                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }

                        $CSPricing->os_price_default = 1;
                        $CSPricing->os_id= $s_optional_default[$i];
                        $CSPricing->os_name= $s_optional_names[$i];
                        $CSPricing->os_price= "";



                        $To_os_price_default  = 1;
                        $To_os_id= $s_optional_default[$i];
                        $To_os_name = $s_optional_names[$i];
                        $To_os_price = "";

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){   $CSPricing->save();   }
                        else{

                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->car_model = $model_name;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->sb_id = $service_brand_id;
                            $pricing->sb_name = $service_brand_name;

                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;


                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->active = 1;
                            $pricing->save();
                        }

                    }

                }//END For Loop of car models
            }
        }
        else {
            //Service brand and optional service selected, only service is there
            foreach($c_models as $c_model){

                $car_model = CarModelTrim::find($c_model);
                $model_name = $car_model->name;

                $CSPricing = new CSPricing();
                $CSPricing->cb_id = $c_brand;
                $CSPricing->car_brand = $car_brand;
                $CSPricing->cy_id = $c_year;
                $CSPricing->car_year = $car_year;
                $CSPricing->cm_id = $c_model;
                $CSPricing->car_model = $model_name;
                $CSPricing->s_id = $s_category_service;
                $CSPricing->s_name = $s_name;
                $CSPricing->sb_id = $service_brand_id;
                $CSPricing->sb_name = $service_brand_name;

                // check if price for service came empty or if exist
                if($s_price){
                    if($s_price =="")
                    {
                        $CSPricing->s_price_default = 1;
                        $CSPricing->s_price = "";
                        $To_s_price = "";
                        $To_s_price_default  = 1;
                    }else {
                        $CSPricing->s_price = $s_price;
                        $CSPricing->s_price_default = 0;
                        $To_s_price = $s_price;
                        $To_s_price_default  = 0;
                    }
                } else{
                    //default was checked
                    $CSPricing->s_price_default = 1;
                    $CSPricing->s_price = "";
                    $To_s_price = "";
                    $To_s_price_default  = 1;
                }

                    //check if pricing for same variables already there

                $pricing = CSPricing::where('cb_id',$c_brand)
                    ->where('cy_id',$c_year)
                    ->where('cm_id',$c_model)
                    ->where('s_id',$s_category_service)
                    ->first();
                if(is_null($pricing)){
                    $CSPricing->save();
                }
                else{
                    $pricing->cb_id = $c_brand;
                    $pricing->car_brand = $car_brand;
                    $pricing->cy_id = $c_year;
                    $pricing->car_year = $car_year;
                    $pricing->cm_id = $c_model;
                    $CSPricing->car_model = $model_name;
                    $pricing->s_id = $s_category_service;
                    $pricing->s_name = $s_name;

                    $pricing->s_price_default = $To_s_price_default;
                    $pricing->s_price = $To_s_price;

                    $pricing->active = 1;
                    $pricing->save();

                }
            }
        }
/*        if(!$s_category_service){
            $prices = CSPricing::where('cb_id',$c_brand)
                ->where('cy_id',$c_year)
                ->where('cm_id',$c_model)
                ->where('s_id',$s_category_service)
                ->get();

            foreach($prices as $price){
                $price->s_price_default = $To_s_price_default;
                $price->s_price = $To_s_price;
                $price->s_hours = $s_hours;
                $price->s_mints = $s_mints;
                $price->active = 1;
                $price->save();
            }
        }*/

        return redirect()->route("admin.pricing.view")->with('successMessage', 'Added pricing successfully.');
        //return redirect()->back()->with('errorMessage', 'Failed update status');
    }



    public function OLD_AddPricing(Request $request){

//   return $request->input();

        $s_brand = $request->input('s_brand');
        $s_category_service = $request->input('s_category_service');
        $s_name  = $request->input('s_name');
        $s_price = ltrim($request->input('s_price'));
        $s_price_default = $request->input('s_price_default');

        $s_hours = $request->input('s_hours');
        $s_mints = $request->input('s_mints');


        $brand_service_prices  = $request->input('brand_service_prices');
        $brand_service_names  = $request->input('brand_service_names');
        $brand_service_ids  = $request->input('brand_service_ids');
        $brand_service_default = $request->input('brand_service_default');

        $s_optional_prices = $request->input('s_optional_prices');
        $s_optional_names = $request->input('s_optional_names');
        $s_optional_ids = $request->input('s_optional_ids');
        $s_optional_default = $request->input('s_optional_default');

        $s_optional_hours = $request->input('s_optional_hours');
        $s_optional_mints = $request->input('s_optional_mints');

        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');
        $c_year = $request->input('c_year');
        $car_year = $request->input('car_year');
        /*$car_model = $request->input('car_model');*/
        $c_models = $request->input('c_models');

        if(!$s_category_service){
            alert()->error('Sorry, Please select service', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }
        if(!$c_models){
            alert()->error('Sorry, Please select at least one vehicle model', 'Warning')->autoclose(5000);
            return redirect('/administrator/#/Pricing/new');
        }



        $bs_length =  sizeof($brand_service_ids);
        $os_length =  sizeof($s_optional_ids);

        $bs_default_length =  sizeof($brand_service_default);
        $os_default_length =  sizeof($s_optional_default);

        //Inserting pricing values
        if($bs_length>0 || $bs_length>0 || $bs_default_length>0 || $os_default_length>0){

            $loop_size = max($bs_length, $os_length, $bs_default_length, $os_default_length);

            for($i=0;$i<$loop_size;$i++) {

                foreach($c_models as $c_model){

                    if($bs_length > $i){ //############################ Brand Service prices input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;

                        $CSPricing->s_hours = $s_hours;
                        $CSPricing->s_mints = $s_mints;

                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }


                        $CSPricing->bs_id= $brand_service_ids[$i];
                        $To_bs_id= $brand_service_ids[$i];

                        if(ltrim($brand_service_prices[$i])==""){
                            $CSPricing->bs_price_default = 1;
                            $CSPricing->bs_name= $brand_service_names[$i];
                            $CSPricing->bs_price= "";
                            $To_bs_price_default  = 1;
                            $To_bs_name = $brand_service_names[$i];
                            $To_bs_price = "";
                        }else{
                            $CSPricing->bs_price_default = 0;
                            $CSPricing->bs_name= $brand_service_names[$i];
                            $CSPricing->bs_price= ltrim($brand_service_prices[$i]);
                            $To_bs_price_default  = 0;
                            $To_bs_name = $brand_service_names[$i];
                            $To_bs_price = $brand_service_prices[$i];
                        }

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('bs_id',$To_bs_id )
                            ->first();

                        if(!$pricing){  $CSPricing->save();   }
                        else{
                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;
                            $pricing->bs_price_default = $To_bs_price_default;
                            $pricing->bs_price= $To_bs_price;
                            $pricing->bs_name= $To_bs_name;
                            $pricing->s_hours = $s_hours;
                            $pricing->s_mints = $s_mints;


                            $pricing->active = 1;
                            $pricing->save();
                        }

                    }
                    if($bs_default_length > $i){ //################ Brand service's default checkbox input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;

                        $CSPricing->s_hours = $s_hours;
                        $CSPricing->s_mints = $s_mints;


                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }


                        $CSPricing->bs_price_default = 1;
                        $CSPricing->bs_id= $brand_service_default[$i];
                        $CSPricing->bs_name= $brand_service_names[$i];
                        $CSPricing->bs_price= "";

                        $To_bs_price_default  = 1;
                        $To_bs_id= $brand_service_default[$i];
                        $To_bs_name = $brand_service_names[$i];
                        $To_bs_price = "";

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('bs_id',$To_bs_id )
                            ->first();

                        if(!$pricing){  $CSPricing->save();   }
                        else{
                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;
                            $pricing->bs_price_default = $To_bs_price_default;
                            $pricing->bs_price= $To_bs_price;
                            $pricing->bs_name= $To_bs_name;
                            $pricing->s_hours = $s_hours;
                            $pricing->s_mints = $s_mints;

                            $pricing->active = 1;
                            $pricing->save();
                        }
                    }

                    if($os_length > $i){ //############################ optional Service prices input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                        $CSPricing->s_hours = $s_hours;
                        $CSPricing->s_mints = $s_mints;


                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }


                        //$s_optional_prices
                        //$s_optional_names
                        //$s_optional_ids
                        //$s_optional_default

                        $CSPricing->os_id= $s_optional_ids[$i];
                        $To_os_id= $s_optional_ids[$i];

                        if(ltrim($s_optional_prices[$i])==""){
                            $CSPricing->os_price_default = 1;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= "";
                            $CSPricing->os_hours= ltrim($s_optional_hours[$i]);
                            $CSPricing->os_mints= ltrim($s_optional_mints[$i]);

                            $To_os_price_default  = 1;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = "";
                        }else{
                            $CSPricing->os_price_default = 0;
                            $CSPricing->os_name= $s_optional_names[$i];
                            $CSPricing->os_price= ltrim($s_optional_prices[$i]);
                            $CSPricing->os_hours= ltrim($s_optional_hours[$i]);
                            $CSPricing->os_mints= ltrim($s_optional_mints[$i]);

                            $To_os_price_default  = 0;
                            $To_os_name = $s_optional_names[$i];
                            $To_os_price = $s_optional_prices[$i];
                        }

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){  $CSPricing->save();   }
                        else{
                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;
                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->os_hours= ltrim($s_optional_hours[$i]);
                            $pricing->os_mints= ltrim($s_optional_mints[$i]);

                            $pricing->active = 1;
                            $pricing->save();
                        }
                    }
                    if($os_default_length > $i){ //################ Brand service's default checkbox input

                        $CSPricing = new CSPricing();
                        $CSPricing->cb_id = $c_brand;
                        $CSPricing->car_brand = $car_brand;
                        $CSPricing->cy_id = $c_year;
                        $CSPricing->car_year = $car_year;
                        $CSPricing->cm_id = $c_model;
                        $CSPricing->s_id = $s_category_service;
                        $CSPricing->s_name = $s_name;
                        $CSPricing->s_hours = $s_hours;
                        $CSPricing->s_mints = $s_mints;


                        if($s_price){
                            if($s_price =="")
                            {
                                $CSPricing->s_price_default = 1;
                                $CSPricing->s_price = "";
                                $To_s_price = "";
                                $To_s_price_default  = 1;
                            }else {
                                $CSPricing->s_price = $s_price;
                                $CSPricing->s_price_default = 0;
                                $To_s_price = $s_price;
                                $To_s_price_default  = 0;
                            }
                        } else{
                            //default was checked
                            $CSPricing->s_price_default = 1;
                            $CSPricing->s_price = "";
                            $To_s_price = "";
                            $To_s_price_default  = 1;
                        }

                        $CSPricing->os_price_default = 1;
                        $CSPricing->os_id= $s_optional_default[$i];
                        $CSPricing->os_name= $s_optional_names[$i];
                        $CSPricing->os_price= "";
                        $CSPricing->os_hours= "";
                        $CSPricing->os_mints= "";


                        $To_os_price_default  = 1;
                        $To_os_id= $s_optional_default[$i];
                        $To_os_name = $s_optional_names[$i];
                        $To_os_price = "";

                        $pricing = CSPricing::where('cb_id',$c_brand)
                            ->where('cy_id',$c_year)
                            ->where('cm_id',$c_model)
                            ->where('s_id',$s_category_service)
                            ->where('os_id',$To_os_id )
                            ->first();

                        if(!$pricing){  $CSPricing->save();   }
                        else{
                            //pricing does exist previously, update it with input values
                            $pricing->cb_id = $c_brand;
                            $pricing->car_brand = $car_brand;
                            $pricing->cy_id = $c_year;
                            $pricing->car_year = $car_year;
                            $pricing->cm_id = $c_model;
                            $pricing->s_id = $s_category_service;
                            $pricing->s_name = $s_name;
                            $pricing->s_price_default = $To_s_price_default;
                            $pricing->s_price = $To_s_price;

                            $pricing->s_hours = $s_hours;
                            $pricing->s_mints = $s_mints;

                            $pricing->os_price_default = $To_os_price_default;
                            $pricing->os_price= $To_os_price;
                            $pricing->os_name= $To_os_name;

                            $pricing->os_hours= ltrim($s_optional_hours[$i]);
                            $pricing->os_mints= ltrim($s_optional_mints[$i]);


                            $pricing->active = 1;
                            $pricing->save();
                        }

                    }

                }//END For Loop of car models
            }
        }
        else {
            //Service brand and optional service selected, only service is there
            foreach($c_models as $c_model){

                $CSPricing = new CSPricing();
                $CSPricing->cb_id = $c_brand;
                $CSPricing->car_brand = $car_brand;
                $CSPricing->cy_id = $c_year;
                $CSPricing->car_year = $car_year;
                $CSPricing->cm_id = $c_model;
                /*$CSPricing->car_model = $car_model;*/
                $CSPricing->s_id = $s_category_service;
                $CSPricing->s_name = $s_name;
                $CSPricing->s_hours = $s_hours;
                $CSPricing->s_mints = $s_mints;


                if($s_price){
                    if($s_price =="")
                    {
                        $CSPricing->s_price_default = 1;
                        $CSPricing->s_price = "";
                        $To_s_price = "";
                        $To_s_price_default  = 1;
                    }else {
                        $CSPricing->s_price = $s_price;
                        $CSPricing->s_price_default = 0;
                        $To_s_price = $s_price;
                        $To_s_price_default  = 0;
                    }
                } else{
                    //default was checked
                    $CSPricing->s_price_default = 1;
                    $CSPricing->s_price = "";
                    $To_s_price = "";
                    $To_s_price_default  = 1;
                }

                $pricing = CSPricing::where('cb_id',$c_brand)
                    ->where('cy_id',$c_year)
                    ->where('cm_id',$c_model)
                    ->where('s_id',$s_category_service)
                    ->first();
                if(!$pricing) {
                    $CSPricing->save();
                }
                else{
                    $pricing->cb_id = $c_brand;
                    $pricing->car_brand = $car_brand;
                    $pricing->cy_id = $c_year;
                    $pricing->car_year = $car_year;
                    $pricing->cm_id = $c_model;
                    $pricing->s_id = $s_category_service;
                    $pricing->s_name = $s_name;

                    $pricing->s_price_default = $To_s_price_default;
                    $pricing->s_price = $To_s_price;

                    $pricing->active = 1;
                    $pricing->save();

                }
            }
        }
        /*                if(!$s_category_service){
                            $prices = CSPricing::where('cb_id',$c_brand)
                                ->where('cy_id',$c_year)
                                ->where('cm_id',$c_model)
                                ->where('s_id',$s_category_service)
                                ->get();

                            foreach($prices as $price){
                                $price->s_price_default = $To_s_price_default;
                                $price->s_price = $To_s_price;
                                $price->s_hours = $s_hours;
                                $price->s_mints = $s_mints;
                                $price->active = 1;
                                $price->save();
                            }
                        }*/

        return redirect()->route("admin.pricing.view")->with('successMessage', 'Added pricing successfully.');
        //return redirect()->back()->with('errorMessage', 'Failed update status');


    }

    public function PricingSearch(Request $request){


        /*return $request->input();*/
        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');
        $c_year = $request->input('c_year');
        $car_year = $request->input('car_year');
        $c_model = $request->input('c_model');
        $car_model = $request->input('car_model');

        //return view('admin.pricing.pricing_search');



        $results = DB::table('c_s_pricing')
            ->join('c_brands', 'c_s_pricing.cb_id', '=', 'c_brands.id')
            ->join('c_years', 'c_s_pricing.cy_id', '=', 'c_years.id')
            ->join('c_models_trims', 'c_s_pricing.cm_id', '=', 'c_models_trims.id')
            ->join('s_category_services', 'c_s_pricing.s_id', '=', 's_category_services.id')
            ->leftJoin('s_brands', 'c_s_pricing.sb_id', '=', 's_brands.id')
            ->leftJoin('service_optionals', 'c_s_pricing.os_id', '=', 'service_optionals.id')
            ->select(
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                's_category_services.id as s_id','s_category_services.name as s_name',
                's_brands.id as sb_id','s_brands.name as sb_name',
                'service_optionals.id as os_id','service_optionals.name as os_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                'c_s_pricing.id as pricing_id',
                'c_s_pricing.s_price as s_price', 'c_s_pricing.os_price as os_price',
                'c_s_pricing.os_price_default as os_price_default',
                'c_s_pricing.active as pricing_active','c_s_pricing.s_price_default as s_price_default'
            )
            ->where('c_brands.id',$c_brand)
            ->where('c_years.id',$c_year)
            /*->where('c_models_trims.id',$c_model)*/
            ->orderBy('c_s_pricing.id', 'desc')
            ->paginate(100);

        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();


        return view('admin.pricing.pricing_search')
            ->with('car_brand', $car_brand)
            ->with('car_year', $car_year)
            ->with('car_model', $car_model)
            ->with('prices', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function OLD_PricingSearch(Request $request){

        /*return $request->input();*/
        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');
        $c_year = $request->input('c_year');
        $car_year = $request->input('car_year');
        $c_model = $request->input('c_model');
        $car_model = $request->input('car_model');

        //return view('admin.pricing.pricing_search');

        $results = DB::table('c_s_pricing')
            ->join('c_brands', 'c_s_pricing.cb_id', '=', 'c_brands.id')
            ->join('c_years', 'c_s_pricing.cy_id', '=', 'c_years.id')
            ->join('c_models_trims', 'c_s_pricing.cm_id', '=', 'c_models_trims.id')
            ->join('s_category_services', 'c_s_pricing.s_id', '=', 's_category_services.id')
            ->leftJoin('s_brand_services', 'c_s_pricing.bs_id', '=', 's_brand_services.id')
            ->leftJoin('service_optionals', 'c_s_pricing.os_id', '=', 'service_optionals.id')
            ->select(
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                's_category_services.id as s_id','s_category_services.name as service_name',
                's_brand_services.id as bs_id','s_brand_services.name as brand_service_name',
                'service_optionals.id as os_id','service_optionals.name as service_optional_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',

                'c_s_pricing.id as pricing_id',

                'c_s_pricing.s_price as s_price','c_s_pricing.bs_price as bs_price', 'c_s_pricing.os_price as os_price',
                'c_s_pricing.bs_price_default as bs_price_default', 'c_s_pricing.os_price_default as os_price_default',
                'c_s_pricing.active as pricing_active','c_s_pricing.s_price_default as s_price_default',
                'c_s_pricing.s_hours as s_hours','c_s_pricing.s_mints as s_mints',
                'c_s_pricing.os_mints as os_mints','c_s_pricing.os_hours as os_hours'

            )
            ->where('c_brands.id',$c_brand)
            ->where('c_years.id',$c_year)
            /*->where('c_models_trims.id',$c_model)*/
            ->orderBy('c_s_pricing.id', 'desc')
            ->paginate(100);

        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();


        return view('admin.pricing.pricing_search')
            ->with('car_brand', $car_brand)
            ->with('car_year', $car_year)
            ->with('car_model', $car_model)
            ->with('prices', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }

    public function PricingView()
    {


        $results = DB::table('c_s_pricing')
            ->join('c_brands', 'c_s_pricing.cb_id', '=', 'c_brands.id')
            ->join('c_years', 'c_s_pricing.cy_id', '=', 'c_years.id')
            ->join('c_models_trims', 'c_s_pricing.cm_id', '=', 'c_models_trims.id')
            ->join('s_category_services', 'c_s_pricing.s_id', '=', 's_category_services.id')
            ->leftJoin('s_brands', 'c_s_pricing.sb_id', '=', 's_brands.id')
            ->leftJoin('service_optionals', 'c_s_pricing.os_id', '=', 'service_optionals.id')
            ->select(
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                's_category_services.id as s_id','s_category_services.name as s_name',
                's_brands.id as sb_id','s_brands.name as sb_name',
                'service_optionals.id as os_id','service_optionals.name as os_name',
                'c_s_pricing.s_price as s_price', 'c_s_pricing.bs_price as bs_price', 'c_s_pricing.os_price as os_price',
                'c_s_pricing.bs_price_default as bs_price_default', 'c_s_pricing.os_price_default as os_price_default',
                'c_s_pricing.active as pricing_active', 'c_s_pricing.id as pricing_id','c_s_pricing.s_price_default as s_price_default',
                'c_s_pricing.s_hours as s_hours','c_s_pricing.s_mints as s_mints',
                'c_s_pricing.s_hours as s_hours','c_s_pricing.s_mints as s_mints',
                'c_s_pricing.os_mints as os_mints','c_s_pricing.os_hours as os_hours',
                'c_s_pricing.id as c_s_pricing_id'



            )
            ->orderBy('c_s_pricing.id', 'desc')->paginate(15);

        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.pricing.pricing_list')
            ->with('prices', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }


    public function OLD_PricingView()
    {


        $results = DB::table('c_s_pricing')
            ->join('c_brands', 'c_s_pricing.cb_id', '=', 'c_brands.id')
            ->join('c_years', 'c_s_pricing.cy_id', '=', 'c_years.id')
            ->join('c_models_trims', 'c_s_pricing.cm_id', '=', 'c_models_trims.id')
            ->join('s_category_services', 'c_s_pricing.s_id', '=', 's_category_services.id')
            ->leftJoin('s_brand_services', 'c_s_pricing.bs_id', '=', 's_brand_services.id')
            ->leftJoin('service_optionals', 'c_s_pricing.os_id', '=', 'service_optionals.id')
            ->select(
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                's_category_services.id as s_id','s_category_services.name as service_name',
                's_brand_services.id as bs_id','s_brand_services.name as brand_service_name',
                'service_optionals.id as os_id','service_optionals.name as service_optional_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                'c_s_pricing.s_price as s_price', 'c_s_pricing.bs_price as bs_price', 'c_s_pricing.os_price as os_price',
                'c_s_pricing.bs_price_default as bs_price_default', 'c_s_pricing.os_price_default as os_price_default',
                'c_s_pricing.active as pricing_active', 'c_s_pricing.id as pricing_id','c_s_pricing.s_price_default as s_price_default',
                'c_s_pricing.s_hours as s_hours','c_s_pricing.s_mints as s_mints',
                'c_s_pricing.s_hours as s_hours','c_s_pricing.s_mints as s_mints',
                'c_s_pricing.os_mints as os_mints','c_s_pricing.os_hours as os_hours',
                'c_s_pricing.id as c_s_pricing_id'



            )
            ->orderBy('c_s_pricing.id', 'desc')->paginate(15);

        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.pricing.pricing_list')
            ->with('prices', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }



    public function PricingUpdateStatus(Request $request){
        $CSPricing = CSPricing::find($request->input('pricing_id'));

        $CSPricing->active = !$request->input('pricing_active');


        if($CSPricing->save()) {
            return redirect()->route("admin.pricing.view")->with('successMessage', 'Pricing Status updated Successfully');
        }

        return redirect()->route("admin.pricing.view")->with('errorMessage', 'Failed to update Pricing status');

    }
    public  function DestroyPrices(Request $request){

        //return $request->input("checked_prices");

        if(CSPricing::destroy($request->input("checked_prices"))){

            return redirect()->route("admin.pricing.view")->with('successMessage', 'Successfully deleted the record(s)');

        }else{
            return redirect()->route("admin.pricing.view")->with('errorMessage', 'Failed to delete the record(s)');
        }

    }

    public  function DestroyPrice($c_s_id){
        $c_s_id = (array)$c_s_id;

        /*$CarModelTrim2 = CSPricing::find($c_s_id);
        return $CarModelTrim2;*/

        if(CSPricing::destroy($c_s_id)){
            return redirect()->route("admin.pricing.view")->with('successMessage', 'Successfully deleted the record(s)');
        }else{
            return redirect()->route("admin.pricing.view")->with('errorMessage', 'Failed to delete the record(s)');
        }

    }

}