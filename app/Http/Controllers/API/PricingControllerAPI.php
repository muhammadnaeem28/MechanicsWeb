<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\ServiceTime;
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
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Authorizer;

/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/21/2016
 * Time: 3:47 PM
 */
class PricingControllerAPI extends ApiController
{




    public function __construct()
    {

        /*	$this->middleware('auth');*/
    }
    public function Price(Request $request) {

        $cb_id = $request->input("cb_id");
        $cy_id = $request->input("cy_id");
        $cm_id = $request->input("cm_id");
        $s_ids= $request->input("s_id");



        $s_prices = array();

        if(is_array($s_ids)){

            foreach($s_ids as $s_id){
                if($s_id!="" ){

                    $s_price_item = array();
                    $price = CSPricing::where('cb_id',$cb_id)
                        ->where('cy_id',$cy_id)
                        ->where('cm_id',$cm_id)
                        ->where('s_id',$s_id)
                        ->first();

                    if($price){
                        if($price->s_price_default==1){

                            $service = CategoryServices::find('id',$price->s_id)->get();
                            $s_name = $service->name;
                            $s_price = $service->price;
                            $s_price_default = 1;
                            $s_hours = $service->s_hours;
                            $s_mints = $service->s_mints;

                        }else{

                            $s_name = $price->s_name;
                            $s_price = $price->s_price;
                            $s_price_default = 0;
                            $s_hours = $price->s_hours;
                            $s_mints = $price->s_mints;

                        }

                        $s_price_item["s_id"] = $s_id;
                        $s_price_item["service_name"] = $s_name;
                        $s_price_item["price"] = $s_price;
                        $s_price_item["price_default"] = $s_price_default;
                        $s_price_item["hours"] = $s_hours;
                        $s_price_item["mints"] = $s_mints;

                        array_push($s_prices,$s_price_item);
                    }else{
                        //service does not exist in pricing section
                        $service = CategoryServices::find($s_id);
                        if($service){


                            $s_price_item["s_id"] = $s_id;
                            $s_price_item["service_name"] = $service->name;
                            $s_price_item["price"] = $service->s_price;
                            $s_price_item["price_default"] = 1;
                            $s_price_item["hours"] = $service->s_hours;
                            $s_price_item["mints"] = $service->s_mints;;

                            array_push($s_prices,$s_price_item);
                        }

                    }

                }
            }

        }else{

            return $this->respondNotFound('s_id input is not an array.');
        }


        return Response()->json([
            'code'=>'200',
            'data'=>[
                'pricing' => $s_prices,
                'parent_cb_id'=> $cb_id,
                'parent_cy_id'=> $cy_id,
                'parent_cm_id'=> $cm_id,
            ]
        ]);

    }


public function PriceWithBrands(Request $request) {

        $cb_id = $request->input("cb_id");
        $cy_id = $request->input("cy_id");
        $cm_id = $request->input("cm_id");
        $s_ids= $request->input("s_id");
     $b_ids= $request->input("b_id");

    $check_s_item = array();
    $s_prices = array();

    /*if($b_ids){
        return "brands";
    }else{
    return "no brand";
    }*/
    if(is_array($s_ids)){

    if($b_ids) {
        if($b_ids[0]!="" ) {
            $brand_s_ids = array();
            $nonbrand_s_ids = array();

                foreach ($b_ids as $b_id) {
                $brand = ServiceBrands::where('id', $b_id)->first();
                if ($brand) {

                    $check_s_item['s_id'] = $brand->s_id;
                    $check_s_item['b_id'] = $brand->id;

                    array_push($brand_s_ids, $check_s_item);

                }
            }

            // return $brand_s_ids;

            if (sizeof($brand_s_ids) > 0) {
                $temp = 0;
                foreach ($s_ids as $s_id) {

                    for ($i = 0; $i < sizeof($brand_s_ids); $i++) {

                        if ($brand_s_ids[$i]["s_id"] == $s_id) {
                            $temp = 1;
                            //array_push($nonbrand_s_ids,$s_id);
                        }
                    }
                    if ($temp == 0) {
                        array_push($nonbrand_s_ids, $s_id);
                    }
                    $temp = 0;
                }

            }
            // return $nonbrand_s_ids;

            foreach ($nonbrand_s_ids as $nonbrand_s_id) {

                if ($nonbrand_s_id != "") {

                    $s_price_item = array();
                    $price = CSPricing::where('cb_id', $cb_id)
                        ->where('cy_id', $cy_id)
                        ->where('cm_id', $cm_id)
                        ->where('s_id', $nonbrand_s_id)
                        ->first();

                    if ($price) {
                        if ($price->s_price_default == 1) {
                            $service = CategoryServices::find($price->s_id);
                            $s_name = $service->name;
                            $s_price = $service->price;
                            $s_price_default = 1;
                            $s_hours = $service->s_hours;
                            $s_mints = $service->s_mints;

                        } else {

                            $s_name = $price->s_name;
                            $s_price = $price->s_price;
                            $s_price_default = 0;
                            $s_hours = $price->s_hours;
                            $s_mints = $price->s_mints;

                        }

                        $s_price_item["s_id"] = $nonbrand_s_id;
                        $s_price_item["service_name"] = $s_name;
                        $s_price_item["price"] = $s_price;
                        $s_price_item["price_default"] = $s_price_default;
                        $s_price_item["hours"] = $s_hours;
                        $s_price_item["mints"] = $s_mints;

                        array_push($s_prices, $s_price_item);
                    } else {
                        //service does not exist in pricing section
                        $service = CategoryServices::find($nonbrand_s_id);
                        if ($service) {


                            $s_price_item["s_id"] = $nonbrand_s_id;
                            $s_price_item["service_name"] = $service->name;
                            $s_price_item["price"] = $service->s_price;
                            $s_price_item["price_default"] = 1;
                            $s_price_item["hours"] = $service->s_hours;
                            $s_price_item["mints"] = $service->s_mints;;

                            array_push($s_prices, $s_price_item);
                        }

                    }

                }

            }// foreach of $nonbrand_s_ids
            //return $s_prices;
    ///////////////////////////////////////////////////////////////$brand_s_id below

            foreach ($brand_s_ids as $brand_s_id) {

                if ($brand_s_id['s_id'] != "") {

                    $s_price_item = array();
                    $price = CSPricing::where('cb_id', $cb_id)
                        ->where('cy_id', $cy_id)
                        ->where('cm_id', $cm_id)
                        ->where('s_id', $brand_s_id['s_id'])
                        ->where('sb_id', $brand_s_id['b_id'])
                        ->first();

                    if ($price) {
                        if ($price->sb_price_default == 1) {

                            // return $price;
                            $service = ServiceBrands::find($brand_s_id['b_id']);
                            $s_name = $service->name;
                            $s_price = $service->price;
                            $s_price_default = 1;
                            $s_hours = $service->s_hours;
                            $s_mints = $service->s_mints;
                            // return $service;
                        } else {

                            $s_name = $price->s_name;
                            $s_price = $price->s_price;
                            $s_price_default = 0;
                            $s_hours = $price->s_hours;
                            $s_mints = $price->s_mints;

                        }

                        $s_price_item["s_id"] = $brand_s_id['s_id'];
                        $s_price_item["b_id"] = $brand_s_id['b_id'];
                        $s_price_item["service_name"] = $s_name;
                        $s_price_item["price"] = $s_price;
                        $s_price_item["price_default"] = $s_price_default;
                        $s_price_item["hours"] = $s_hours;
                        $s_price_item["mints"] = $s_mints;

                        array_push($s_prices, $s_price_item);
                    } else {
                        //service does not exist in pricing section

                        $service = ServiceBrands::find($brand_s_id['b_id']);
                        if ($service) {

                            //return $service;

                            $s_price_item["s_id"] = $brand_s_id['s_id'];
                            $s_price_item["b_id"] = $brand_s_id['b_id'];
                            $s_price_item["service_name"] = $service->name;
                            $s_price_item["price"] = $service->s_price;
                            $s_price_item["price_default"] = 1;
                            $s_price_item["hours"] = $service->s_hours;
                            $s_price_item["mints"] = $service->s_mints;;

                            array_push($s_prices, $s_price_item);
                        }

                    }

                }

            }// foreach of $brand_s_id

        }
    }else{//no brands are there

        foreach($s_ids as $s_id){
            if($s_id!="" ){

                $s_price_item = array();
                $price = CSPricing::where('cb_id',$cb_id)
                    ->where('cy_id',$cy_id)
                    ->where('cm_id',$cm_id)
                    ->where('s_id',$s_id)
                    ->first();

                if($price){
                    if($price->s_price_default==1){

                        $service = CategoryServices::find('id',$price->s_id)->get();
                        $s_name = $service->name;
                        $s_price = $service->price;
                        $s_price_default = 1;
                        $s_hours = $service->s_hours;
                        $s_mints = $service->s_mints;

                    }else{

                        $s_name = $price->s_name;
                        $s_price = $price->s_price;
                        $s_price_default = 0;
                        $s_hours = $price->s_hours;
                        $s_mints = $price->s_mints;

                    }

                    $s_price_item["s_id"] = $s_id;
                    $s_price_item["service_name"] = $s_name;
                    $s_price_item["price"] = $s_price;
                    $s_price_item["price_default"] = $s_price_default;
                    $s_price_item["hours"] = $s_hours;
                    $s_price_item["mints"] = $s_mints;

                    array_push($s_prices,$s_price_item);
                }else{
                    //service does not exist in pricing section
                    $service = CategoryServices::find($s_id );
                    if($service){


                        $s_price_item["s_id"] = $s_id;
                        $s_price_item["service_name"] = $service->name;
                        $s_price_item["price"] = $service->s_price;
                        $s_price_item["price_default"] = 1;
                        $s_price_item["hours"] = $service->s_hours;
                        $s_price_item["mints"] = $service->s_mints;;

                        array_push($s_prices,$s_price_item);
                    }

                }

            }
        }

    }//
}//END of if is_array($s_ids) && is_array($b_ids)


else{

    return $this->respondNotFound('s_id input is not an array.');
}

        return Response()->json([
            'code'=>'200',
            'data'=>[
                'pricing' => $s_prices,
                'parent_cb_id'=> $cb_id,
                'parent_cy_id'=> $cy_id,
                'parent_cm_id'=> $cm_id,
            ]
        ]);





















            //return $nonbrand_s_ids;

/*        $s_prices = array();

        if(is_array($s_ids)){

            foreach($s_ids as $s_id){
                if($s_id!="" ){

                    $s_price_item = array();
                    $price = CSPricing::where('cb_id',$cb_id)
                        ->where('cy_id',$cy_id)
                        ->where('cm_id',$cm_id)
                        ->where('s_id',$s_id)
                        ->first();

                    if($price){
                        if($price->s_price_default==1){

                            $service = CategoryServices::find('id',$price->s_id)->get();
                            $s_name = $service->name;
                            $s_price = $service->price;
                            $s_price_default = 1;
                            $s_hours = $service->s_hours;
                            $s_mints = $service->s_mints;

                        }else{

                            $s_name = $price->s_name;
                            $s_price = $price->s_price;
                            $s_price_default = 0;
                            $s_hours = $price->s_hours;
                            $s_mints = $price->s_mints;

                        }

                        $s_price_item["s_id"] = $s_id;
                        $s_price_item["service_name"] = $s_name;
                        $s_price_item["price"] = $s_price;
                        $s_price_item["price_default"] = $s_price_default;
                        $s_price_item["hours"] = $s_hours;
                        $s_price_item["mints"] = $s_mints;

                        array_push($s_prices,$s_price_item);
                    }else{
                        //service does not exist in pricing section
                        $service = CategoryServices::find($s_id );
                        if($service){


                            $s_price_item["s_id"] = $s_id;
                            $s_price_item["service_name"] = $service->name;
                            $s_price_item["price"] = $service->s_price;
                            $s_price_item["price_default"] = 1;
                            $s_price_item["hours"] = $service->s_hours;
                            $s_price_item["mints"] = $service->s_mints;;

                            array_push($s_prices,$s_price_item);
                        }

                    }

                }
            }

        }else{

            return $this->respondNotFound('s_id input is not an array.');
        }

        return Response()->json([
            'code'=>'200',
            'data'=>[
                'pricing' => $s_prices,
                'parent_cb_id'=> $cb_id,
                'parent_cy_id'=> $cy_id,
                'parent_cm_id'=> $cm_id,
            ]
        ]);*/
    }


    public function ServiceTime(){

        $result = ServiceTime::find(1);


        return Response()->json([
            'code'=>'200',
            'data'=>[
                'start' => $result->start,
                'end' => $result->end,
                'unlimited' => $result->unlimited,
                'mon' => $result->mon,
                'tue' => $result->tue,
                'wed' => $result->wed,
                'thur' => $result->thur,
                'fri' => $result->fri,
                'sat' => $result->sat,
                'sun' => $result->sun,
            ]
        ]);


    }


    /*    public function Price(Request $request) {

        //return $request->input();
        $cb_id = $request->input("cb_id");
        $cy_id = $request->input("cy_id");
        $cm_id = $request->input("cm_id");
          $s_id= $request->input("s_id");

        $price = CSPricing::where('cb_id',$cb_id)
                            ->where('cy_id',$cy_id)
                            ->where('cm_id',$cm_id)
                            ->where('s_id',$s_id)
                            ->first();

        //return $price;

        if(!$price) {
            return $this->respondNotFound('Price does not exist.');
        }


        if($price->s_price_default==1){
            $service = CategoryServices::find('id',$price->s_id)->get();
            $s_price = $service->price;
            $s_hours = $service->s_hours;
            $s_mints = $service->s_mints;

        }else{
            $s_price = $price->s_price;
            $s_hours = $price->s_hours;
            $s_mints = $price->s_mints;
        }

        return Response()->json([
            'code'=>'200',
f

    }



    */

}