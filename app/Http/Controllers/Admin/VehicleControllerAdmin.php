<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 7/8/2016
 * Time: 3:31 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInfoRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Vehicles\CarBrand;
use App\Models\Vehicles\CarYear;
use App\Models\Vehicles\CarModelTrim;

use App\Models\Vehicles\CarModel;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use App\Models\ServiceCategory;
use App\Models\Vehicles\LOVCarYear;
use App\Models\Vehicles\LOVCarBrand;
use App\Models\Vehicles\LOVCarModel;
use App\Models\Vehicles\BrandYear;
use App\Models\Vehicles\CarBrandYear;
use Alert;
use Image;
use Auth;
use DB;
use App\Http\Requests;
use Validator;

class VehicleControllerAdmin extends Controller
{
    /**
     * create a new instance
     */
    public function __construct()
    {

    }

    public function IndexLOV()
    {
        $years= LOVCarYear::all()->count();
        $brands= LOVCarBrand::all()->count();
        $models= LOVCarModel::all()->count();
        return view('admin.vehicles.lov')
            ->with('years',$years)
            ->with('brands',$brands)
            ->with('models',$models);
    }
    public function IndexLOVYear()
    {
        $results = LOVCarYear::orderBy('name', 'desc')->get();
        return view('admin.vehicles.lov_year_view')
            ->with('years', $results);
    }
    public function NewLOVYear()
    {
        return view('admin.vehicles.lov_year_new');
    }
    public function AddLOVYear(Request $request)
    {
        $lov_year = new LOVCarYear();
        $lov_year->name = $request->input('name');

        if($lov_year->save()) {
            return redirect()->route('admin.vehicle.lov-year.index')->with('successMessage', 'Successfully Added new year');
        }
        return redirect()->route('admin.vehicle.lov-year.index')->with('errorMessage', 'Failed to add new year');
    }
    public function EditLOVYear($id)
    {

        $year = LOVCarYear::find($id);
        if(!$year) {
            return redirect()->back()->with('errorMessage', 'List of value not found');
        }
        return view('admin.vehicles.lov_year_edit', compact('year'));
    }
    public function UpdateLOVYear(Request $request)
    {
        $lov_year = LOVCarYear::find($request->input('id'));

        $lov_year->name = $request->input('name');

        if($lov_year->save()) {
            return redirect()->route('admin.vehicle.lov-year.index')->with('successMessage', 'Successfully updated year');
        }
        return redirect()->route('admin.vehicle.lov-year.index')->with('errorMessage', 'Failed to updated year');

    }


//LOV Brand

    public function IndexLOVBrand()
    {
        $results = LOVCarBrand::all();
        return view('admin.vehicles.lov_brand_view')
            ->with('brands', $results);
    }
    public function NewLOVBrand()
    {
        return view('admin.vehicles.lov_brand_new');
    }
    public function AddLOVBrand(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $lov_Brand = new LOVCarBrand();
        $lov_Brand->name = $request->input('name');
        $lov_Brand_name = $request->input('name');

/*        if ($request->hasFile('brand_image'))
        {
            if(! empty($lov_Brand->image_url)){
                if(file_exists(public_path() . $lov_Brand->image_url)){
                    if($lov_Brand->image_url != "/wb-content/img/default-brand-img.png"){
                        unlink(public_path() . $lov_Brand->image_url);
                    }



                }
            }

            $image = $request->file('brand_image');
            $filename  =  $lov_Brand_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();
            $path = public_path('wb-content/img/brands/' . $filename);
            //Image::make($image->getRealPath())->fit(600, 600)->save($path);
            Image::make($image->getRealPath())->save($path);

            $lov_Brand->image_url = '/wb-content/img/brands/' . $filename;

        }*/

    if ($request->hasFile('brand_image')) {

        if(!empty($lov_Brand->image_url)){
            if(file_exists(public_path() . $lov_Brand->image_url)){
                if($lov_Brand->image_url != "/web_content/img/default_brand_img.png"){
                    unlink(public_path() . $lov_Brand->image_url);
                }



            }
        }
        $image = $request->file('brand_image');
        $filename  =  $lov_Brand_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();

        $destinationPath = 'web_content/img/brands/'; // upload path
        //$extension = $request->file('brand_image')->getClientOriginalExtension(); // getting image extension
       // $fileName = rand(11111,99999).'.'.$extension; // renameing image
        $request->file('brand_image')->move($destinationPath, $filename); // uploading file to given path
        $lov_Brand->image_url = '/web_content/img/brands/' . $filename;
    }


        if($lov_Brand->save()) {
            return redirect()->route('admin.vehicle.lov-brand.index')->with('successMessage', 'Successfully Added new Brand');
        }
        return redirect()->route('admin.vehicle.lov-brand.index')->with('errorMessage', 'Failed to add new Brand');

    }
    public function EditLOVBrand($id)
    {

        $brand = LOVCarBrand::find($id);
        if(!$brand) {
            return redirect()->back()->with('errorMessage', 'List of value not found');
        }
        return view('admin.vehicles.lov_brand_edit', compact('brand'));
    }


    public function UpdateLOVBrand(Request $request)
    {

        $lov_Brand = LOVCarBrand::find($request->input('id'));

        $lov_Brand->name = $request->input('name');
        $lov_Brand_name = $request->input('name');
        if ($request->hasFile('brand_image')) {

            if(!empty($lov_Brand->image_url)){
                if(file_exists(public_path() . $lov_Brand->image_url)){
                    if($lov_Brand->image_url != "/web_content/img/default_brand_img.png"){
                        unlink(public_path() . $lov_Brand->image_url);
                    }



                }
            }
            $image = $request->file('brand_image');
            $filename  =  $lov_Brand_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'web_content/img/brands/'; // upload path
            //$extension = $request->file('brand_image')->getClientOriginalExtension(); // getting image extension
            // $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('brand_image')->move($destinationPath, $filename); // uploading file to given path
            $lov_Brand->image_url = '/web_content/img/brands/' . $filename;
        }

        if($lov_Brand->save()) {
            return redirect()->route('admin.vehicle.lov-brand.index')->with('successMessage', 'Successfully updated Brand');
        }
        return redirect()->route('admin.vehicle.lov-brand.index')->with('errorMessage', 'Failed to updated Brand');

    }

    public function DeleteLOVBrand($id){
        $brand = LOVCarBrand::find($id);


        if($brand->delete()) {

            return redirect()->back()->with('successMessage', 'Successfully deleted the Brand');
        }

        return redirect()->back()->with('errorMessage', 'Failed to delete the Brand ');

    }





//LOV Models

    public function IndexLOVmodel()
    {
        $results = LOVCarModel::orderBy('id', 'desc')->paginate(15);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.vehicles.lov_model_view')
            ->with('models', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function SearchLOVmodel(Request $request)
    {
        $keyword = $request->Input('keyword');
        $results = LOVCarModel::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.vehicles.lov_model_view')
            ->with('models',$results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);
    }

    public function NewLOVmodel()
    {
        return view('admin.vehicles.lov_model_new');
    }
    public function AddLOVmodel(Request $request)
    {
        $lov_model = new LOVCarModel();
        $lov_model->name = $request->input('name');

        if($lov_model->save()) {
            return redirect()->route('admin.vehicle.lov-model.index')->with('successMessage', 'Successfully Added new model');
        }
        return redirect()->route('admin.vehicle.lov-model.index')->with('errorMessage', 'Failed to add new model');
    }
    public function EditLOVmodel($id)
    {

        $model = LOVCarModel::find($id);
        if(!$model) {
            return redirect()->back()->with('errorMessage', 'List of value not found');
        }
        return view('admin.vehicles.lov_model_edit', compact('model'));
    }
    public function UpdateLOVmodel(Request $request)
    {
        $lov_model = LOVCarModel::find($request->input('id'));

        $lov_model->name = $request->input('name');

        if($lov_model->save()) {
            return redirect()->route('admin.vehicle.lov-model.index')->with('successMessage', 'Successfully updated model');
        }
        return redirect()->route('admin.vehicle.lov-model.index')->with('errorMessage', 'Failed to updated model');

    }



    public function NewVehicle()
    {
        return view('admin.vehicles.vehicle_new')
            ->with('brands',LOVCarBrand::all())
            ->with('years',LOVCarYear::all())
            ->with('models',LOVCarModel::all());
    }

    public function AddMakeBrandPartial(Request $request){
        $view = view('admin.vehicles.partials.make_vehicle');
        if($request->ajax()) {
            $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'*/
            return response($sections['content']); // this will only return whats in the content section
        }
    }
    public function AddVehicle(Request $request)
    {
        $years = $request->input('years');


        $trims = $request->input('trims');

        if(!$years) {
            return redirect()->back()->with('errorMessage', 'Select Year');
        }
        /*if(!$trims[0]) {
            return redirect()->back()->with('errorMessage', 'Enter at least one trim of vehicle');
        }*/


        $engine_oil = $request->input('engine_oil');
        $gear_oil = $request->input('gear_oil');
        $power_steering_oil  = $request->input('power_steering_oil');

        $model = LOVCarModel::find($request->input('model'));
        $brand = LOVCarBrand::find($request->input('brand'));


        $CheckBrand = CarBrand::where('name',$brand->name)->first();

        if(!$CheckBrand){

            $Cbrand = new CarBrand();
            $Cbrand->name = $brand->name;
            $Cbrand->desc = $brand->desc;
            $Cbrand->image_url = $brand->image_url;
            $Cbrand->save();

            $Cbrand_id = $Cbrand->id;
            $Cbrand_name = $Cbrand->name;

        }
        else{
            $Cbrand_id=$CheckBrand->id;
            $Cbrand_name=$CheckBrand->name;


        }

        foreach($years as $year) {

            $LOVCarYear = LOVCarYear::find($year);

            $CheckYear = CarYear::where('name', $LOVCarYear->name)->first();
            if (!$CheckYear) {
                $CYear = new CarYear();
                $CYear->name = $LOVCarYear->name;
                $CYear->save();
                $CYear_id=$CYear->id;
                $CYear_name=$CYear->name;

            }else{$CYear_id=$CheckYear ->id;$CYear_name=$CheckYear ->name; }

            $CheckBrandYear = CarBrandYear::where('year_id', $CYear_id)
                                            ->where('brand_id',$Cbrand_id)
                                            ->where('active',1)->first();

            if(!$CheckBrandYear){
                $CBrandYear = new CarBrandYear();
                $CBrandYear->brand_id = $Cbrand_id;
                $CBrandYear->brand = $Cbrand_name;
                $CBrandYear->year_id = $CYear_id;
                $CBrandYear->year = $CYear_name;
                $CBrandYear->save();
            }

            foreach($trims as $trim)
            {   $Check_CarModelTrim = CarModelTrim::where('name',$model->name)
                                                    ->where('trim',$trim)
                                                    ->where('year_id',$CYear_id)
                                                    ->where('brand_id',$Cbrand_id)
                                                    ->where('active',1)->first();
                if(!$Check_CarModelTrim){
                    //return "model and trim does not exist";
                    $CModelTrim = new CarModelTrim();
                    $CModelTrim->name = $model->name;
                    $CModelTrim->trim = $trim;
                    $CModelTrim->engine_oil = $engine_oil;
                    $CModelTrim->gear_oil = $gear_oil;
                    $CModelTrim->power_steering_oil = $power_steering_oil;
                    $CModelTrim->image_url= $model->image_url;
                    $CModelTrim->desc = $model->desc;
                    $CModelTrim->year_id = $CYear_id;
                    $CModelTrim->year = $CYear_name;
                    $CModelTrim->brand_id = $Cbrand_id;
                    $CModelTrim->brand = $Cbrand_name;

                    $CModelTrim->save();
                }else{//return "model and trim exist";}
                }
            }
        }





            return redirect()->route('admin.vehicle.list')->with('successMessage', 'Vehicle(s) Added successfully');
/*        return view('admin.vehicles.vehicle_new')
            ->with('brands',LOVCarBrand::all())
            ->with('years',LOVCarYear::all())
            ->with('models',LOVCarModel::all());*/
    }

    public function VehicleSearch(Request $request){


        $c_brand = $request->input('c_brand');
        $car_brand = $request->input('car_brand');

        $c_year = $request->input('c_year');



        $car_year = $request->input('car_year');
        $c_model = $request->input('c_model');
        $car_model = $request->input('car_model');

        $results = DB::table('c_models_trims')
            ->join('c_brands', 'c_models_trims.brand_id', '=', 'c_brands.id')
            ->join('c_years', 'c_models_trims.year_id', '=', 'c_years.id')
            ->join('c_brand_year', function ($join) {
                $join->on('c_models_trims.year_id', '=', 'c_brand_year.year_id')
                    ->on('c_models_trims.brand_id', '=', 'c_brand_year.brand_id');

            })
            ->select(
                'c_brands.id as brand_id', 'c_brands.name as brand_name', 'c_brands.desc as brand_desc', 'c_brands.image_url as brand_img',
                'c_years.id as year_id','c_years.name as year_name','c_years.desc as year_desc',
                'c_models_trims.id as model_trim_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                'c_models_trims.desc as model_trim_desc', 'c_models_trims.image_url as model_img',
                'c_models_trims.engine_oil as engine_oil','c_models_trims.gear_oil as gear_oil',
                'c_models_trims.power_steering_oil as power_steering_oil',
                'c_brand_year.active as brand_year_active','c_models_trims.active as model_trim_active',
                'c_brand_year.id as brand_year_id','c_models_trims.id as model_trim_id'

            )
            ->where('c_brands.id', $c_brand)
            ->where('c_years.id', $c_year)
            ->orderBy('c_models_trims.id', 'desc')->paginate(40);


        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.vehicles.vehicles_search_result')
            ->with('car_brand', $car_brand)
            ->with('car_year', $car_year)
            ->with('vehicles', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);


    }

// display Vehicles list
    public function VehiclesList(){

    $results = DB::table('c_models_trims')
    ->join('c_brands', 'c_models_trims.brand_id', '=', 'c_brands.id')
    ->join('c_years', 'c_models_trims.year_id', '=', 'c_years.id')
    ->join('c_brand_year', function ($join) {
        $join->on('c_models_trims.year_id', '=', 'c_brand_year.year_id')
             ->on('c_models_trims.brand_id', '=', 'c_brand_year.brand_id');

    })
    ->select(
        'c_brands.id as brand_id', 'c_brands.name as brand_name', 'c_brands.desc as brand_desc', 'c_brands.image_url as brand_img',
        'c_years.id as year_id','c_years.name as year_name','c_years.desc as year_desc',
        'c_models_trims.id as model_trim_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
        'c_models_trims.desc as model_trim_desc', 'c_models_trims.image_url as model_img',
        'c_models_trims.engine_oil as engine_oil','c_models_trims.gear_oil as gear_oil',
        'c_models_trims.power_steering_oil as power_steering_oil',
        'c_brand_year.active as brand_year_active','c_models_trims.active as model_trim_active',
        'c_brand_year.id as brand_year_id','c_models_trims.id as model_trim_id'

    )/*->where('c_brand_year.active','1')
     ->where('c_models_trims.active','1')*/
    ->orderBy('c_models_trims.id', 'desc')->paginate(30);
    //->get();

        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.vehicles.vehicles_list')
            ->with('vehicles', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }


    public function DestroyVehicle($model_id){

             $var = (array)$model_id;
        if(CarModelTrim::destroy($var)){
            return redirect()->back()->with('successMessage', 'Successfully deleted the record(s)');
        }else{
            return redirect()->back()->with('errorMessage', 'Failed to delete the record(s)');
        }
    }

    public function DestroyVehicles(Request $request){
        $models = $request->input("checked_vehicles");
        if(CarModelTrim::destroy($models)){
            return redirect()->route("admin.vehicle.list")->with('successMessage', 'Successfully deleted the record(s)');
        }else{
            return redirect()->route("admin.vehicle.list")->with('errorMessage', 'Failed to delete the record(s)');
        }
    }


    public function VehicleUpdateStatus(Request $request){
        /*$brand_year = CarBrandYear::find($request->input('brand_year_id'));*/
        $model_trim = CarModelTrim::find($request->input('model_trim_id'));

        /*$brand_year->active = !$request->input('brand_year_active');*/
        $model_trim->active = !$request->input('model_trim_active');


        if($model_trim->save()) {
            return redirect()->route("admin.vehicle.list")->with('successMessage', 'Vehicle Status updated Successfully');
        }

        return redirect()->route("admin.vehicle.list")->with('errorMessage', 'Failed to update Vehicle status');
    }






    public function ProfileUpdate(ProfileRequest $request) {


        $user = User::find(Auth::user()->id);

        $user_name = $request->input('name');

        $user_name = preg_replace('/\s+/','',$user_name);


        if ($request->hasFile('brand_image'))
        {
            if(! empty($user->image_url)){
                if(file_exists(public_path() . $user->image_url)){
                    if($user->image_url != "/wb-content/img/default-img.png"){
                        unlink(public_path() . $user->image_url);
                    }



                }
            }

            $image = $request->file('brand_image');
            $filename  =  $user_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();
            $path = public_path('wb-content/img/' . $filename);
            Image::make($image->getRealPath())->fit(600, 600)->save($path);

            $user->image_url = '/wb-content/img/' . $filename;

        }








        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if( $request->input('phone') == '')
            $user->phone = null;
        else
            $user->phone = $request->input('phone');

        $user->video_url = $request->input('video_url');
        $user->biography = $request->input('biography');
        $user->location = $request->input('location');
        $user->languages = $request->input('languages');

        if( $request->input('time_zone_id') == '')
            $user->time_zone_id = null;
        else
            $user->time_zone_id = $request->input('time_zone_id');


        /*        if(Auth::user()->email != $request->input('email')){

                    $check_user = DB::table('users')->where('email', '=', $request->input('email'))->where('id','!=',$user->id)->get();

                    if($check_user)
                        $error_msg =  "Email you entered already taken.";

                }
                $user->email = $request->input('email');*/

        if($request->input('sub_newsletters')==1)
            $user->sub_newsletters = 1;
        else
            $user->sub_newsletters = 0;

        if($request->input('sub_sms_alerts')==1)
            $user->sub_sms_alerts = 1;
        else
            $user->sub_sms_alerts = 0;



        if($user->save()) {


            alert('Your Profile has been Updated.')->persistent('Great !');

            return redirect()->route('user.profile.edit');
        }



        return redirect()->back();
    }




}



