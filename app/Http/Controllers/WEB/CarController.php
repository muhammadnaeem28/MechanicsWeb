<?php

/**

 * Created by PhpStorm.

 * User: Speridian

 * Date: 7/8/2016

 * Time: 3:31 PM

 */



namespace App\Http\Controllers\WEB;



use App\Http\Controllers\Controller;

use App\Models\Customers\SAppointments;
use App\Models\Customers\SQuotations;
use App\Models\Customers\SQuotationServices;
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

use App\Models\Customers\CustomerCars;

use Alert;

use Image;

use Auth;

use App\Http\Requests;

use Validator;

class CarController extends ApiController
{
    /**
     * create a new instance
     */

    public function __construct()
    {

    }


    public function CarAdd(Request $request)
    {


        $cb_id = $request->input("cb_id");
        $cy_id = $request->input("cy_id");
        $cm_id = $request->input("cm_id");
        $user_id = $request->input("user_id");

        $c_car_old = CustomerCars::where('customer_id', $user_id)
            ->where('cb_id', $cb_id)
            ->where('cy_id', $cy_id)
            ->where('cm_id', $cm_id)
            ->first();

        if (!$c_car_old) {

            $c_car_new = new CustomerCars();
            $c_car_new->customer_id = $user_id;
            $c_car_new->cb_id = $cb_id;
            $c_car_new->cy_id = $cy_id;
            $c_car_new->cm_id = $cm_id;
            $c_car_new->save();

            return Response()->json([
                'code' => '200',
                'car_id' => $c_car_new->id,
                'message' => 'Record created successfully.',
            ]);


        } else {
            $c_car_old->customer_id = $user_id;
            $c_car_old->cb_id = $cb_id;
            $c_car_old->cy_id = $cy_id;
            $c_car_old->cm_id = $cm_id;
            $c_car_old->save();

            //409 Conflict
            return Response()->json([
                'code' => '409',
                'car_id' => $c_car_old->id,
                'message' => 'Record already exists.',
            ]);

        }


    }

    public function UpdateMileage(Request $request)
    {

        $user_id = $request->input("user_id");
        $car_id = $request->input("car_id");
        $total_mileage = $request->input("total_mileage");
        $daily_mileage = $request->input("daily_mileage");

         $user_car = CustomerCars::where('customer_id', $user_id)
            ->where('id', $car_id)
            ->first();

        if ($user_car) {

            $user_car->total_mileage= $total_mileage;
            $user_car->daily_mileage = $daily_mileage;
            $user_car->save();

            return Response()->json([
                'code' => '200',
                'message' => 'Record updated successfully.',
            ]);


        }else {
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }



    }

    public function CarDelete(Request $request)
    {

        $user_id = $request->input("user_id");
        $car_id = $request->input("car_id");


        $user_car = CustomerCars::where('customer_id', $user_id)
            ->where('id', $car_id)
            ->first();

        if($user_car){
            if($user_car->delete()){
                return Response()->json([
                    'code' => '200',
                    'message' => 'Record deleted successfully.',
                ]);


            }
        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }

    }
    public function CarList(Request $request)
    {

        
        $user_id = $request->input("user_id");

        $user_car = CustomerCars::where('customer_id', $user_id)->first();

        if($user_car){


            $results = DB::table('c_cars')
                ->leftJoin('c_brands', 'c_cars.cb_id', '=', 'c_brands.id')
                ->leftJoin('c_years', 'c_cars.cy_id', '=', 'c_years.id')
                ->leftJoin('c_models_trims', 'c_cars.cm_id', '=', 'c_models_trims.id')
                ->select(
                    'c_cars.id as car_id', 'c_cars.customer_id as user_id',
                    'c_brands.id as cb_id', 'c_brands.name as brand_name','c_brands.image_url as brand_image',
                    'c_years.id as cy_id','c_years.name as year_name',
                    'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                    'c_cars.total_mileage as total_mileage', 'c_cars.daily_mileage as daiL_mileage',
                    'c_cars.image_url as image_url', 'c_cars.daily_mileage as daiL_mileage'
                )->orderBy('c_cars.id', 'desc')->get();

                return Response()->json([
                    'code' => '200',
                    'cars' => $results,
                ]);

        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }

    }

}


