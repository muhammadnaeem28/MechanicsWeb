<?php


namespace App\Http\Controllers\API;

use App\Models\CategoryServices;
use App\Models\ServiceCategory;
use App\Models\Vehicles\CarBrand;
use App\Http\Controllers\Controller;

use App\Models\CustomerCar;
use App\Models\Vehicles\CarBrandYear;
use App\Models\Vehicles\CarModelTrim;
use App\Models\Vehicles\CarYear;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Authorizer;

/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/21/2016
 * Time: 3:47 PM
 */


class ServiceControllerAPI extends ApiController
{


    protected $serviceCategoryTransformer;
    protected $categoryServicesTransformer;

    /*FoodTransformer $FoodTransformer*/
    public function __construct(
        ServiceCategoryTransformer $ServiceCategoryTransformer,
        CategoryServicesTransformer $CategoryServicesTransformer
    )
    {
        $this->serviceCategoryTransformer = $ServiceCategoryTransformer;
        $this->categoryServicesTransformer = $CategoryServicesTransformer;

    }

    public function index(Authorizer $authorizer) {
        $user_id=$authorizer->getResourceOwnerId(); // the token user_id
        $user=\App\User::find($user_id);// get the user data from database
    }

    public function ServiceCategories() {

        $s_categories = ServiceCategory::where('active',1)->get();

        return Response()->json([
            'code'=>'200',
            'data'=>[
                'message'=>'All Service Categories',
                'categories' => $this->serviceCategoryTransformer->transformCollection($s_categories->all())
            ]
        ]);

    }
    public function CategoryServices(Request $request) {

        $services = CategoryServices::where('s_category_id',$request->input('s_category_id'))->where('active',1)->get();

        if(!$services) {
            return $this->respondNotFound('Service does not exist.');
        }




            return Response()->json([
                'code'=>'200',
                'data'=>[
                    'message'=>'price',
                    'services' => $this->categoryServicesTransformer->transformCollection($services->all()),
                    'parent_s_category_id'=> $request->input('s_category_id'),
                ]
            ]);


    }


    public function CarModelsTrims(Request $request) {

            $year_id = $request->input('year_id');
            $brand_id = $request->input('brand_id');

            $models = CarModelTrim::where('year_id',$year_id)->where('brand_id',$brand_id)->get();

        if(!$models) {
            return $this->respondNotFound('Vehicle Models does not exist.');
        }
        return Response()->json([
                'code'=>'200',
                'data'=>[
                    'message'=>'Vehicle models and their trims',
                    'models_trims' => $this->carModelTrimTransformer->transformCollection($models->all()),
                    'parent_brand_id'=> $brand_id,
                    'parent_year_id'=> $year_id,
                ]
            ]);

    }


/*    public function CarBands() {

        $cars = CarBrand::all();

        return Response()->json([
            'cars' => $this->carBrandTransformer->transformCollection($cars->all())
        ]);
    }*/


}