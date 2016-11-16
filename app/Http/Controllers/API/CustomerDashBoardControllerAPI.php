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
class CustomerDashBoardControllerAPI extends ApiController
{


    protected $customerAppointments;


    /*FoodTransformer $FoodTransformer*/
    public function __construct(
        CustomerAppointmentsTransformer $CustomerAppointments

    )
    {
        $this->customerAppointments = $CustomerAppointments;
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
                    'c_brands.id as cb_id', 'c_brands.name as brand_name',
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

    public function CustomerQuotations(Request $request){

        $user_id = $request->input("user_id");

        $user_quotation = SQuotations::where('customer_id', $user_id)->first();

        if($user_quotation){


            $results = DB::table('s_quotations')
                ->leftJoin('c_cars', 's_quotations.car_id', '=', 'c_cars.id')
                ->leftJoin('c_brands', 'c_cars.cb_id', '=', 'c_brands.id')
                ->leftJoin('c_years', 'c_cars.cy_id', '=', 'c_years.id')
                ->leftJoin('c_models_trims', 'c_cars.cm_id', '=', 'c_models_trims.id')
                ->select(
                    's_quotations.id as quote_id', 's_quotations.quote_no as quote_number',
                    's_quotations.status as status','s_quotations.total_price as total_price',
                    'c_cars.id as car_id',
                    'c_brands.id as cb_id', 'c_brands.name as brand_name',
                    'c_years.id as cy_id','c_years.name as year_name',
                    'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                    'c_cars.total_mileage as total_mileage', 'c_cars.daily_mileage as daiL_mileage',
                    'c_cars.image_url as image_url'
                )->where('s_quotations.customer_id', $user_id)->orderBy('s_quotations.id', 'desc')->get();

            return Response()->json([
                'code' => '200',
                'quotations' => $results,
            ]);

        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }
    }

    public function QuotationServices(Request $req){

        $quote_id = $req->input("quote_id");

        $user_quotation = SQuotations::find($quote_id);

        if($user_quotation){

            //here we will query s_quotation_service table and will make its join with other services table
            // to get services name
            $results = DB::table('s_quotation_services')
                ->leftJoin('s_category_services', 's_quotation_services.s_id', '=', 's_category_services.id')
                ->leftJoin('s_brands', 's_quotation_services.bs_id', '=', 's_brands.id')
                ->leftJoin('service_optionals', 's_quotation_services.os_id', '=','service_optionals.id')
                ->select(
                    's_quotation_services.id as id',

                    's_quotation_services.quote_id as quote_id',

                    's_category_services.name as s_name',

                    's_quotation_services.s_price as s_price',

                    's_brands.name as brand_name',

                    'service_optionals.name as os_name',

                    's_quotation_services.os_price as os_price'

                )->where('s_quotation_services.quote_id', $user_quotation->id)->orderBy('s_quotation_services.id', 'desc')->get();




            return Response()->json([
                'code' => '200',
                'services' => $results,
            ]);


        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }
    }


    public function CustomerAppointments(Request $request){

        $user_id = $request->input("user_id");

        $user_appointments = SAppointments::where('customer_id', $user_id)->first();

        if($user_appointments){


            $results = DB::table('s_appointments')
                ->leftJoin('c_cars', 's_appointments.car_id', '=', 'c_cars.id')
                ->leftJoin('c_brands', 'c_cars.cb_id', '=', 'c_brands.id')
                ->leftJoin('c_years', 'c_cars.cy_id', '=', 'c_years.id')
                ->leftJoin('c_models_trims', 'c_cars.cm_id', '=', 'c_models_trims.id')
                ->select(
                    's_appointments.id as appointment_id', 's_appointments.appointment_no as appointment_number',
                    's_appointments.status as status', 's_appointments.payment_type as payment_type','s_appointments.total_price as total_price',
                    'c_cars.id as car_id',
                    'c_brands.id as cb_id', 'c_brands.name as brand_name',
                    'c_years.id as cy_id','c_years.name as year_name',
                    'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                    'c_cars.total_mileage as total_mileage', 'c_cars.daily_mileage as daiL_mileage',
                    'c_cars.image_url as image_url'
                )->where('s_appointments.customer_id', $user_id)->orderBy('s_appointments.id', 'desc')->get();

            return Response()->json([
                'code' => '200',
                'appointments' => $results,
            ]);

        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
            ]);

        }
    }



    public function AppointmentServices(Request $req){

        $appointment_id = $req->input("appointment_id");

        $user_appointment = SAppointments::find($appointment_id);

        if($user_appointment){

            //here we will query s_quotation_service table and will make its join with other services table
            // to get services name
            $results = DB::table('s_appointment_services')
                ->leftJoin('s_category_services', 's_appointment_services.s_id', '=', 's_category_services.id')
                ->leftJoin('s_brands', 's_appointment_services.bs_id', '=', 's_brands.id')
                ->leftJoin('service_optionals', 's_appointment_services.os_id', '=','service_optionals.id')
                ->select(
                    's_appointment_services.id as id',

                    's_appointment_services.appointment_id as quote_id',

                    's_category_services.name as s_name',

                    's_appointment_services.s_price as s_price',

                    's_brands.name as brand_name',

                    'service_optionals.name as os_name',

                    's_appointment_services.os_price as os_price'

                )->where('s_appointment_services.appointment_id', $user_appointment->id)->orderBy('s_appointment_services.id', 'desc')->get();




            return Response()->json([
                'code' => '200',
                'services' => $results,
            ]);


        }else{
            return Response()->json([
                'code' => '404',
                'message' => 'Record does not found.',
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
            'phone' => 'required',
            'full_address' => 'required',

        ]);



        $s_start_time = $request->input("s_start_time");

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