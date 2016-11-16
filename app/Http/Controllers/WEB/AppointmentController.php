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

use App\Models\Customers\CustomerCars;

use Alert;

use Image;

use Auth;

use App\Http\Requests;

use Validator;

class AppointmentController extends ApiController

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

        if(!$result) {

            return $this->respondNotFound('Category does not exist.');

        }



        $results = $result->services;

        return response($results);

    }



    public function IndexServices()

    {

        $results = CategoryServices::all();

        return response($results);

    }



    public function GetService($s_id)

    {

        $result = CategoryServices::find($s_id);

        return response($result);

    }



    public function IndexInspection()

    {

        $keyword="Inspection";

        $result = ServiceCategory::where('name','LIKE','%'.$keyword.'%')->first();



        if(!$result) {

            return $this->respondNotFound('Category does not exist.');

        }

        $results = $result->services;

        return response($results);

    }







    public function IndexServiceOptionals($s_id)

    {

        $result = CategoryServices::find($s_id);

        if(!$result) {

            return $this->respondNotFound('Service does not exist.');

        }

        $results = $result->optionals;

        return response($results);

    }



    public function IndexServiceBrands($s_id)
    {

        $result = CategoryServices::find($s_id);

        if(!$result) {

            return $this->respondNotFound('Service does not exist.');

        }

        $results = ServiceBrands::where('s_id',$s_id)->get();



        return response($results);

    }

    public function IndexAllServiceBrands()

    {

        $results = ServiceBrands::all();

        return response($results);

    }





    public function IndexServiceBrandTypes($s_brand_id)

    {

        $result = ServiceBrands::find($s_brand_id);

        if(!$result) {

            return $this->respondNotFound('Service Brand does not exist.');

        }

        $results = $result->services;

        return $results;

    }





    public function IndexVehicleBrands(){

        $results = CarBrand::where("active","1")->get();



        return response($results);

    }



    public function IndexBrandYears($brand_id){



        $result = CarBrand::find($brand_id);

        if(!$result) {

            return $this->respondNotFound('Vehicle Brand does not exist.');

        }



        $results = $result->years;

        return response($results);

    }



    public function IndexVehicleModels($brand_id,$year_id){

        $brand = CarBrand::find($brand_id);

        if(!$brand) {

            return $this->respondNotFound('Vehicle Brand does not exist.');

        }



        $results = CarModelTrim::where('year_id',$year_id)->where('brand_id',$brand_id)->where("active","1")->groupBy('name')->get();



        return response($results);

    }



    public function Price(Request $request){





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





            return Response()->json([

                'code'=>'200',

                'data'=>[

                    'message'=>'No price',

                    'price' => '',

                    'hours' => '',

                    'mints' => '',

                    'parent_cb_id'=> $cb_id,

                    'parent_cy_id'=> $cy_id,

                    'parent_cm_id'=> $cm_id,

                    'parent_s_id'=> $s_id,

                ]

            ]);







        }else{

            $s_price = $price->s_price;

            $s_hours = $price->s_hours;

            $s_mints = $price->s_mints;





            return Response()->json([

                'code'=>'200',

                'data'=>[

                    'message'=>'Price',

                    'price' => $s_price,

                    'hours' => $s_hours,

                    'mints' => $s_mints,

                    'parent_cb_id'=> $cb_id,

                    'parent_cy_id'=> $cy_id,

                    'parent_cm_id'=> $cm_id,

                    'parent_s_id'=> $s_id,

                ]

            ]);







        }







    }





    public function ServiceTime(){



        $result = ServiceTime::find(1);

        return response($result);



    }






//    public function Checkout(Request $request){
/*
        $result = json_decode($request->getContent(), true);

        $car_info = $result["car_info"];
        $car_id = $car_info[0]['data']['id'];
        return response($result);


    }*/

    public function Checkout(Request $request)
    {
        // we will first create car for customer, after checking if the came care is there or not already.. c_cars is the table for this

        //then we will create record in s_quotation table against car_id and customer_id.

        // then will add the services and their optional services in s_quotation_services table with s_quoatation_id
        //
        //$result = json_decode($request->getContent(), true);

        $result = json_decode($request->getContent(), true);








        //

        $car_info = $result["car_info"];

        $user_info = $result["user_info"];



        $cb_id = $car_info[0]['data']['id'];
        $cb_name = $car_info[0]['data']['name'];



        $cy_id = $car_info[1]['data']['id'];
        $cy_name = $car_info[1]['data']['name'];

        $cm_id = $car_info[2]['data']['id'];
        $cm_name = $car_info[2]['data']['name'];




        $services_info = $result["services_info"];
        $services_count = count($services_info);


        $optional_services_info = $result["optional_services_info"];
        $optional_services_count = count($optional_services_info);


        $user_info = $result["user_info"];

        $selectedDateTime = $result["selectedDateTime"];
        $totalPrice = $result["totalPrice"];
        $user_id = $user_info['user_id'];



        $user_address_info = $result["user_address"];

        $user_phone = $user_address_info["phoneNumber"];
        $user_address = $user_address_info["address"];



        //return response($user_id);
        //return response($result["optional_services_info"]);

        //return ;

        if($user_address_info["paymentMethod"]=="cash"){
            $payment_method = 1;
        }else{
            $payment_method = 2;

        } $user_id = (int)$user_id;



        $customer = User::find($user_id);
        $customer->phone1 = $user_phone;
        $customer->full_address = $user_address;




            if ($customer->save()) {
                //return response($user_address);
                $c_car_old = CustomerCars::where('cb_id', $cb_id)
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
                    $final_car_id = $c_car_new->id;
                } else {
                    $c_car_old->customer_id = $user_id;
                    $c_car_old->cb_id = $cb_id;
                    $c_car_old->cy_id = $cy_id;
                    $c_car_old->cm_id = $cm_id;
                    $c_car_old->save();

                    $final_car_id = $c_car_old->id;
                }

                $SAppointment = new SAppointments();
                $SAppointment->appointment_no = mt_rand();
                $SAppointment->customer_id = $user_id;
                $SAppointment->car_id = $final_car_id;
                $SAppointment->status_id = 1;
                $SAppointment->status = "New";
                $SAppointment->s_start_time = $selectedDateTime;
                $SAppointment->total_price = $totalPrice;
                if($payment_method==1){
                    $SAppointment->payment_type_id = $payment_method;
                    $SAppointment->payment_type = "Cash on Hand";

                }else{
                    $SAppointment->payment_type_id = $payment_method;
                    $SAppointment->payment_type = "Credit Card";

                }


                if ($SAppointment->save()) {
                    $appointment_id = $SAppointment->id;
                    for ($i = 0; $i < $services_count; $i++) {

                        $SAppointmentService = new SAppointmentServices();

                        if (array_key_exists('b_id', $services_info[$i])) {
                            $SAppointmentService->appointment_id = $appointment_id;
                            $SAppointmentService->s_id = $services_info[$i]['s_id'];
                            $SAppointmentService->s_name = $services_info[$i]['name'];
                            $SAppointmentService->s_price = $services_info[$i]['price'];
                            /*$SAppointmentService->s_time = $services_info[$i]['time'];*/
                            $SAppointmentService->bs_id = $services_info[$i]['b_id'];
                            $SAppointmentService->bs_name = $services_info[$i]['b_name'];
                            $SAppointmentService->save();

                        } else {
                            $SAppointmentService->appointment_id = $appointment_id;
                            $SAppointmentService->s_id = $services_info[$i]['s_id'];
                            /*$SAppointmentService->s_name = $services_info[$i]['name'];*/
                            $SAppointmentService->s_time = $services_info[$i]['time'];
                            $SAppointmentService->save();
                        }

                    }
                    for ($i = 0; $i < $optional_services_count; $i++) {
                        $SAppointmentService = new SAppointmentServices();

                        $SAppointmentService->appointment_id = $appointment_id;
                        $SAppointmentService->s_id = $optional_services_info[$i]['s_id'];
                        $SAppointmentService->os_id = $optional_services_info[$i]["os_id"];
                        $SAppointmentService->os_name = $optional_services_info[$i]['name'];
                        $SAppointmentService->os_price = $optional_services_info[$i]['price'];
                        /*$SAppointmentService->os_time = $services_info[$i]['time'];*/
                        $SAppointmentService->save();
                    }
                    return Response()->json([
                        'code' => '200',
                        'message' => 'Appointment successfully created.',
                    ]);
                }
            }
    }


    public function RequestQuotation(Request $request)
    {
        // we will first create car for customer, after checking if the came care is there or not already.. c_cars is the table for this

        //then we will create record in s_quotation table against car_id and customer_id.

        // then will add the services and their optional services in s_quotation_services table with s_quoatation_id
        //
        $result = json_decode($request->getContent(), true);

        //return response($result);

        $car_info = $result["car_info"];

        $cb_id = $car_info[0]['data']['id'];
        $cb_name = $car_info[0]['data']['name'];

        $cy_id = $car_info[1]['data']['id'];
        $cy_name = $car_info[1]['data']['name'];

        $cm_id = $car_info[2]['data']['id'];
        $cm_name = $car_info[2]['data']['name'];
        $cm_name = $car_info[2]['data']['name'];

        $user_info = $result["user_info"];
        $user_id = $user_info['user_id'];

        $services_info = $result["services_info"];
        $services_count =  count($services_info);


        $optional_services_info = $result["optional_services_info"];
        $optional_services_count = count($optional_services_info);
        $total_services = $services_count+$optional_services_count;

        $c_car_old = CustomerCars::where('cb_id',$cb_id)
            ->where('cy_id',$cy_id)
            ->where('cm_id',$cm_id)
            ->first();

        if(!$c_car_old) {

            $c_car_new = new CustomerCars();
            $c_car_new->customer_id = $user_id ;
            $c_car_new->cb_id = $cb_id;
            $c_car_new->cy_id = $cy_id;
            $c_car_new->cm_id = $cm_id;
            $c_car_new->save();
            $final_car_id = $c_car_new->id;
        }
        else{
            $c_car_old->customer_id = $user_id;
            $c_car_old->cb_id = $cb_id;
            $c_car_old->cy_id = $cy_id;
            $c_car_old->cm_id = $cm_id;
            $c_car_old->save();

            $final_car_id = $c_car_old->id;
        }

        $SQuotation = new SQuotations();
        $SQuotation->quote_no = mt_rand();
        $SQuotation->customer_id = $user_id ;
        $SQuotation->car_id = $final_car_id;
        $SQuotation->status_id = 7;
        $SQuotation->status = "Requested";
        $SQuotation->total_services = $total_services;
        $SQuotation->service1_name = $services_info[0]['name'];


        if($SQuotation->save()){
            $quote_id = $SQuotation->id;
            for($i=0 ;$i<$services_count;$i++ ){
                $SQuotationService = new SQuotationServices();

                if(array_key_exists('b_id', $services_info[$i])){
                    $SQuotationService->quote_id = $quote_id;
                    $SQuotationService->s_id= $services_info[$i]['s_id'];
                    $SQuotationService->s_name= $services_info[$i]['name'];
                    $SQuotationService->s_price= $services_info[$i]['price'];
                    //$SQuotationService->s_time= $services_info[$i]['time'];
                    $SQuotationService->bs_id=$services_info[$i]['b_id'];
                    //$SQuotationService->bs_name=$services_info[$i]['b_name'];
                    $SQuotationService->save();

                }else{
                    $SQuotationService->quote_id = $quote_id;
                    $SQuotationService->s_id= $services_info[$i]['s_id'];
                    $SQuotationService->s_name= $services_info[$i]['name'];
                    /*$SQuotationService->s_time= $services_info[$i]['time'];*/
                    $SQuotationService->save();
                }

            }
            for($i=0 ;$i<$optional_services_count;$i++ ){
                $SQuotationService = new SQuotationServices();

                    $SQuotationService->quote_id= $quote_id;
                    $SQuotationService->s_id= $optional_services_info[$i]['s_id'];
                    $SQuotationService->os_id= $optional_services_info[$i]["os_id"];
                    $SQuotationService->os_name= $services_info[$i]['name'];
                    $SQuotationService->os_price= $services_info[$i]['price'];
                    //$SQuotationService->os_time= $services_info[$i]['time'];
                    $SQuotationService->save();
            }
            return Response()->json([
                'code'=>'200',
                'message'=>'Quotation requested successfully.',
            ]);
        }
    }

    //customer quotations

    public function CustomerQuotations(Request $request){

        $user_id = $request->input("user_id");



        //$user_quotation = SQuotationServices::find($quote_id)->count();

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
                    'c_cars.image_url as image_url',
                    's_quotations.total_services as total_services','s_quotations.service1_name as service1_name',
                    's_quotations.created_at as created_at'
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
    public function QuotationDelete(Request $request)
    {

        $quote_id = $request->input("quote_id");



        $quotatation = SQuotations::find($quote_id);

        if($quotatation){
            if($quotatation->delete()){
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


}



