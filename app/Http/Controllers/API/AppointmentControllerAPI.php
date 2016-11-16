<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


use App\Models\Customers\CustomerCars;
use App\Models\Customers\SAppointments;
use App\Models\Customers\SAppointmentServices;

use App\Models\Customers\SQuotations;
use App\Models\Customers\SQuotationServices;



use App\Models\ServiceTime;
use App\Models\Vehicles\CSPricing;
use App\User;
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
class AppointmentControllerAPI extends ApiController
{

    public function __construct()
    {

        /*	$this->middleware('auth');*/
    }


    public function IndexServiceBrands($s_id)
    {

        $result = CategoryServices::find($s_id);

        if(!$result){

            return $this->respondNotFound('Service does not exist.');
        }

        $results = ServiceBrands::where('s_id',$s_id)->get();

        if($results){
            //return response($results);
            return Response()->json([
                'code'=>'200',
                'brands'=>$results,
            ]);

        }
        else{
            return Response()->json([
                'code'=>'404',
                'message'=>'No brands found.',
            ]);

        }

    }


    public function CheckOut(Request $request) {



        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'cb_id' => 'required',
            'cy_id' => 'required',
            'cm_id' => 'required',
            'price' => 'required',
            's_total_time' => 'required',
            's_start_time' => 'required',
            'phone' => 'required',
            'full_address' => 'required',

        ]);



        //$s_start_time = $request->input("s_start_time");

        if ($validator->fails()) {
            return $this->respondWithError('Some of the inputs are not found.');
        }
        $customer_id = $request->input("customer_id");
        $full_address = $request->input("full_address");
        $street_address = $request->input("street_address");
        $phone = $request->input("phone");


        $customer = User::find($customer_id);
        $customer->full_address = $full_address;
        $customer->street_address = $street_address;
        $customer->phone1 = $phone;

        $cb_id = $request->input("cb_id");
        $cy_id = $request->input("cy_id");
        $cm_id = $request->input("cm_id");

        $s_ids= $request->input("s_id");



/*        $s_total_time = $request->input("s_total_time");
        $s_start_time = $request->input("s_start_time");
        $s_end_time = $request->input("s_end_time");*/

        $s_slot = $request->input("s_total_time");
        $s_date = $request->input("s_start_time");


        /*$s_total_time = "12:00-13:00";
        $s_start_time  = "9-5-2016";*/
        //


        $price = $request->input("price");

        if(is_array($s_ids))
        {
            $c_car_old = CustomerCars::where('cb_id',$cb_id)
                ->where('cy_id',$cy_id)
                ->where('cm_id',$cm_id)
                ->first();

            if(!$c_car_old) {

                $c_car_new = new CustomerCars();
                $c_car_new->customer_id = $customer_id ;
                $c_car_new->cb_id = $cb_id;
                $c_car_new->cy_id = $cy_id;
                $c_car_new->cm_id = $cm_id;
                $c_car_new->save();
                $final_car_id = $c_car_new->id;
            }
            else{

                $c_car_old->customer_id = $customer_id;
                $c_car_old->cb_id = $cb_id;
                $c_car_old->cy_id = $cy_id;
                $c_car_old->cm_id = $cm_id;
                $c_car_old->save();

                $final_car_id = $c_car_old->id;

            }

                $s_appointment = new SAppointments();

                $s_appointment->customer_id = $customer_id ;

                $s_appointment->car_id = $final_car_id;

                $s_appointment->price = $price ;

                $s_appointment->status_id = 3;
                $s_appointment->status = "Scheduled";

                $s_appointment->payment_type_id = 1;
                $s_appointment->payment_type = "Cash on Hand";

/*                $s_appointment->s_total_time = $s_total_time;
                $s_appointment->s_start_time = $s_start_time;
                $s_appointment->s_end_time = $s_end_time;*/
                $s_appointment->s_slot = $s_slot;
                $s_appointment->s_date = $s_date;


                if($s_appointment->save()){

                    foreach($s_ids as $s_id){
                        if($s_id!="" ) {

                            $s_appointment_services = new SAppointmentServices();
                            $s_appointment_services->appointment_id = $s_appointment->id;
                            $s_appointment_services->s_id= $s_id;
                            $s_appointment_services->save();

                            $customer->save();

                        }
                    }
                    //return $this->respondCreated('Appointment Created Successfully.');

                    return Response()->json([
                        'code'=>'200',
                        'message'=>'Appointment Created Successfully',
                    ]);

                }
        }else {
            return $this->respondWithError('s_id is not array.');
        }

    }
}