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

class CustomerDashboardController extends ApiController

{

    protected $s_category;

    protected $s_category_services;

    protected $s_brands;

    protected $s_brand_services;

    protected $optional_services;

    protected $user;

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
        $this->user = new User();

    }



    public function GetCustomerInfo()
    {
        //$categories = ServiceCategory::all();
        if (Auth::check()) {
            // The user is logged in...
                $user = Auth::user();
                return Response()->json([
                    'code'=>'200',
                    'data'=>[
                        'message'=>'User info',
                        'user_id' => $user->id,
                        'fname' => $user->fname,
                        'lname' => $user->lname,
                        'email' => $user->email,
                        'full_address' => $user->full_address,
                        'phone1' => $user->phone1,
                        'phone2' => $user->phone2,
                        'zip' => $user->zip,
                        'sms_alert' => $user->sms_alert,
                        'email_alert' => $user->email_alert
                    ]
                ]);
        }else{
            return $this->respondNotFound('Please sign in first.');
        }
    }

    public function UpdateCustomerInfo(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone1 = $request->input('phone1');
            $user->phone2 = $request->input('phone2');
            $user->full_address = $request->input('full_address');
            $user->zip = $request->input('zip');
            $user->sms_alerts = $request->input('sms_alerts');
            $user->email_alerts = $request->input('email_alerts');

            if($user->save()) {
                return Response()->json([
                    'code'=>'200',
                    'data'=>[
                        'message'=>'Record has been updated'
                    ]
                ]);
            }
        }else{
            return $this->respondNotFound('You are not sign in.');
        }
    }

}



