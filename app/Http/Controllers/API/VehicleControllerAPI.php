<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\CustomerCar;
use App\Models\Vehicles\CarBrandYear;
use App\Models\Vehicles\CarModelTrim;
use App\Models\Vehicles\CarYear;
use App\Models\Vehicles\CarBrand;
use App\Models\Vehicles\LOVCarBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Authorizer;

/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/21/2016
 * Time: 3:47 PM
 */
class VehicleControllerAPI extends ApiController
{


    protected $carBrandTransformer;
    protected $carYearTransformer;
    protected $carModelTrimTransformer;

    /*FoodTransformer $FoodTransformer*/
    public function __construct(
        CarBrandTransformer $CarBrandTransformer,
        CarYearTransformer $CarYearTransformer,
        CarModelTrimTransformer $CarModelTrimTransformer
    )
    {
        $this->carBrandTransformer = $CarBrandTransformer;
        $this->carYearTransformer = $CarYearTransformer;
        $this->carModelTrimTransformer = $CarModelTrimTransformer;
        /*	$this->middleware('auth');*/
    }

    public function index(Authorizer $authorizer) {

        $user_id=$authorizer->getResourceOwnerId(); // the token user_id

        $user=\App\User::find($user_id);// get the user data from database




    }
    public function CarBrands() {

        $cars = CarBrand::all();
        return Response()->json([
            'code'=>'200',
            'data'=>[
                'message'=>'All Vehicles brand names',
                'cars' => $this->carBrandTransformer->transformCollection($cars->all())
            ]
        ]);

    }
    public function CarYears(Request $request) {

            $brand = CarBrand::find($request->input('brand_id'));

        if(!$brand) {
            return $this->respondNotFound('Vehicle Brand does not exist.');
        }


            $years = $brand->years;

            return Response()->json([
                'code'=>'200',
                'data'=>[
                    'message'=>'Brand years',
                    'years' => $this->carYearTransformer->transformCollection($years->all()),
                    'parent_brand_id'=> $brand->id,
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


    public function SaveAngular(Request $request)
    {
        $lov_Brand = new LOVCarBrand();
        $lov_Brand->name = $request->input('data');

        $lov_Brand->save();

/*            return redirect()->route('admin.vehicle.lov-brand.index')->with('successMessage', 'Successfully Added new Brand');
        }
        return redirect()->route('admin.vehicle.lov-brand.index')->with('errorMessage', 'Failed to add new Brand');*/
    }

}	