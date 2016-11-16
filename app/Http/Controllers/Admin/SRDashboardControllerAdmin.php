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

class SRDashboardControllerAdmin extends Controller
{
    /**
     * create a new instance
     */
    public function __construct()
    {
    }


}