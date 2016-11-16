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
use App\Models\CarBrand;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use App\Models\ServiceCategory;
use App\Models\CategoryServices;
use App\Models\ServiceBrands;
use App\Models\BrandServices;
use App\Models\OptionalServices;
use App\Models\ServicesOptionals;
use Alert;
use Image;
use Auth;
use App\Http\Requests;
use DB;

use Validator;

class ServiceControllerAdmin extends Controller
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

// Categoires
    public function IndexCategories()
    {
        $results = $this->s_category->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.categories_list')
            ->with('s_categories', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function IndexCategory($id)
    {
        $results = $this->s_category->where('id',$id)->paginate(1);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.categories_list')
            ->with('s_categories', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function SearchCategory(Request $request)
    {
        $keyword = $request->Input('keyword');
        $s_categories = ServiceCategory::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $s_categories->currentPage();
        $items_per_page = $s_categories->perPage();
        return view('admin.services.categories_list')
            ->with('s_categories',$s_categories)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatusCategory(Request $request)
    {
        $s_category = ServiceCategory::find($request->input('id'));
        $s_category->active = !$request->input('active');
        $boolean = !$request->input('active');
        if($s_category->save()) {

            if($s_category->active!=1){
                $services=$s_category->services;
                foreach($services as $service){
                    $service_found = CategoryServices::find($service->id);
                    $service_found->active=0;
                    $service_found->save();
                }
            }
            //$services_count = $services->count();


            return redirect()->back()->with('successMessage', 'Service Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Service');
    }
    public function DestroyCategory($id)
    {
        $s_category = $this->s_category->find($id);
        if($s_category->delete()) {
            return redirect()->back()->with('successMessage', 'Successfully deleted the Service Category');
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the Service Category');
    }
    public function EditCategory($id)
    {
        $s_category = $this->s_category->find($id);
        if(!$s_category) {
            return redirect()->back()->with('errorMessage', 'Service Category not found');
        }
        return view('admin.services.category_edit', compact('s_category'));
    }
    public function UpdateCategory($id , Request $request)
    {
        $s_category = ServiceCategory::find($id);

        if(! $s_category->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.service.categories.index')->with('errorMessage', 'Failed to Update Service Category');
        }

        return redirect()->route('admin.service.categories.index')->with('successMessage', 'Successfully Updated the Service Category');
    }
    public function NewCategory()
    {
        return view('admin.services.category_new');
    }
    public function AddCategory(Request $request)
    {
        $s_category = new ServiceCategory();
        $s_category->name = $request->input('name');
        $s_category->desc = $request->input('desc');

        if($s_category->save()) {
            return redirect()->route('admin.service.categories.index')->with('successMessage', 'Successfully Added new Service Category');
        }
        return redirect()->route('admin.service.categories.index')->with('errorMessage', 'Failed to add new Service Category');
    }
    public function CategoryServices($id)
    {
        $s_category = $this->s_category->find($id);
        if($s_category->active!=1){

            alert()->error('This service category is inactive', 'Warning')->autoclose(3500);
            return redirect()->back();
        }
        //$results = $s_category->services()->orderBy('id', 'desc')->paginate(10);
        $results = $s_category->services()->orderBy('id', 'desc')->paginate(10);
        //$results = $this->s_category_services->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.services_list')
            ->with('s_category_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);
    }




// category services management
    public function IndexServices ()
    {

        $results = $this->s_category_services->orderBy('id', 'desc')->paginate(10);

        $current_page_number = $results->currentPage();

        $items_per_page = $results->perPage();

        return view('admin.services.services_list')
            ->with('s_category_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function SearchService(Request $request)
    {
        $keyword = $request->Input('keyword');
        $results = ServiceCategory::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.services_list')
            ->with('s_category_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatusService(Request $request)
    {
        $s_category_service = CategoryServices::find($request->input('id'));

        if($s_category_service->active!=1){
            //test if service's category is already inactive
            $category = $s_category_service->category;
            if($category->active!=1){
                alert()->error('This service\'s category is inactive, please active category first', 'Warning')->autoclose(3500);
                return redirect()->back();

                }

        }

        $s_category_service->active = !$request->input('active');
        if($s_category_service->save()) {
            return redirect()->back()->with('successMessage', 'Service Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Service');
    }
    public function DestroyService($id)
    {

        //return $id;
        $s_category_service = $this->s_category_services->find($id);
        if($s_category_service->delete()) {
            return redirect()->back()->with('successMessage', 'Successfully deleted the Service');
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the Service');
    }


    public function EditService($id)
    {
        $s_category_service = $this->s_category_services->find($id);
        if(!$s_category_service) {
            return redirect()->back()->with('errorMessage', 'Service not found');
        }
        return view('admin.services.service_edit', compact('s_category_service'))
            ->with('categories',ServiceCategory::all());
    }
    public function UpdateService($id , Request $request)
    {
        /*$s_category_service = CategoryServices::find($id);
        if(! $s_category_service->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.service.index')->with('errorMessage', 'Failed to Update Service ');
        }
        return redirect()->route('admin.service.index')->with('successMessage', 'Successfully Updated the Service ');
        */

        $s_category_service = CategoryServices::find($id);

        $s_category_service->s_category_id = $request->input('s_category_id');
        $s_category_service->name = $request->input('name');

        $s_category_service_name = $s_category_service->name;

        $s_category_service->price = $request->input('price');
        $s_category_service->desc = $request->input('desc');


        if ($request->hasFile('service_image')) {
            if(!empty($s_category_service->image_url)){
                if(file_exists(public_path() . $s_category_service->image_url)){
                    if($s_category_service->image_url != "/web_content/img/default_service.png"){
                        unlink(public_path() . $s_category_service->image_url);
                    }
                }
            }
            $image = $request->file('service_image');
            $filename  =  $s_category_service_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'web_content/img/services/'; // upload path
            //$extension = $request->file('brand_image')->getClientOriginalExtension(); // getting image extension
            // $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('service_image')->move($destinationPath, $filename); // uploading file to given path
            $s_category_service->image_url = '/web_content/img/services/' . $filename;
        }



        if($s_category_service->save()) {

            return redirect()->route('admin.service.index')->with('successMessage', 'Successfully Updated the Service ');
        }
        return redirect()->route('admin.service.index')->with('errorMessage', 'Failed to Update Service ');
    }

    public function NewService()
    {
                return view('admin.services.service_new')
            ->with('categories',ServiceCategory::all());
    }
    public function AddService(Request $request)
    {
        $s_category_service = new CategoryServices();

        $s_category_service->s_category_id = $request->input('s_category_id');
        $s_category_service->name = $request->input('name');

        $s_category_service_name = $s_category_service->name;

        $s_category_service->price = $request->input('price');
        $s_category_service->desc = $request->input('desc');


        if ($request->hasFile('service_image')) {

            $image = $request->file('service_image');
            $filename  =  $s_category_service_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'web_content/img/services/'; // upload path
            //$extension = $request->file('brand_image')->getClientOriginalExtension(); // getting image extension
            // $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('service_image')->move($destinationPath, $filename); // uploading file to given path
            $s_category_service->image_url = '/web_content/img/services/' . $filename;
        }else{
            $s_category_service->image_url = '/web_content/img/default_service.png';
        }



        if($s_category_service->save()) {
            return redirect()->route('admin.service.index')->with('successMessage', 'Successfully Added new Service ');
        }
        return redirect()->route('admin.service.index')->with('errorMessage', 'Failed to add new Service ');
    }
    public function AddOptionals($id)
    {
        $s_category_service = CategoryServices::find($id);
        return view('admin.services.service_add_optionals')
            ->with('s_category_service',$s_category_service)
            ->with('optional_services',OptionalServices::all());
    }
    public function SaveOptionals(Request $request)
    {
        $services_optionals = new ServicesOptionals();

        $services_optionals->s_id = $request->input('s_id');
        $services_optionals->os_id = $request->input('os_id');


        if($services_optionals->save()) {
            return redirect()->route('admin.service.index')->with('successMessage', 'Successfully Added new Optional Service');
        }
        return redirect()->route('admin.service.index')->with('errorMessage', 'Failed to add new Optional Service');
    }

    public function ViewServiceOptionals($id)
    {
        $s_category_service = CategoryServices::find($id);


        $results = $s_category_service->optionals()->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.services_optionals')
            ->with('optional_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page)
            ->with('s_id',$id)
            ->with('s_name',$s_category_service->name);

    }

    public function DestroyServiceOptional($s_id,$os_id)
    {
//return $os_id    ;
        $service = CategoryServices::find($s_id);
//        $service_optional = ServicesOptionals::where("s_id",$s_id)->where("os_id",$os_id)->get();

        ///return $service_optional;
        /*$user = User::find(Auth::id());*/

        $service->optionals()->detach($os_id);

        return redirect()->back()->with('successMessage', 'Successfully deleted the optional');
/*
        if($service_optional->delete()) {
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the optional');*/
    }


// Service's Brands
    public function IndexServiceBrands()
    {


        $results = $this->s_brand->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.brands_list')
            ->with('s_brands', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function SearchServiceBrand(Request $request)
    {
        $keyword = $request->Input('keyword');
        $results = ServiceBrands::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.brand_list')
            ->with('s_brands', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatusServiceBrand(Request $request)
    {
        $service_brand = ServiceBrands::find($request->input('id'));
        $service_brand->active = !$request->input('active');
        if($service_brand->save()) {
            return redirect()->back()->with('successMessage', 'Service Brand Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Service Brand');
    }
    public function DestroyServiceBrand($id)
    {
        $service_brand = ServiceBrands::find($id);
        if($service_brand->delete()) {
            return redirect()->back()->with('successMessage', 'Successfully deleted the Service brand');
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the Service Brand');
    }
    public function EditServiceBrand($id)
    {

        $s_brand = ServiceBrands::find($id);

        if(!$s_brand) {
            return redirect()->back()->with('errorMessage', 'Service Brand not found');
        }
        return view('admin.services.brand_edit', compact('s_brand'))
            ->with('s_category_services',CategoryServices::all());
    }
    public function UpdateServiceBrand($id , Request $request)
    {
        $service_brand = ServiceBrands::find($id);
        if(!$service_brand->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.service-brand.index')->with('errorMessage', 'Failed to Update Service Brand');
        }
        return redirect()->route('admin.service-brand.index')->with('successMessage', 'Successfully Updated the Service Brand');
    }
    public function NewServiceBrand()
    {
        return view('admin.services.brand_new')
            ->with('categories',ServiceCategory::all())
            ->with('services',CategoryServices::all());
    }
    public function AddServiceBrand(Request $request)
    {
        $service_brand = new ServiceBrands();

        $service_brand->s_id = $request->input('s_id');
        $service_brand->name = $request->input('name');
        $service_brand->price = $request->input('price');
        $service_brand->desc = $request->input('desc');

        if($service_brand->save()) {
            return redirect()->route('admin.service-brand.index')->with('successMessage','Successfully Added new Service Brand');
        }
        return redirect()->route('admin.service-brand.index')->with('errorMessage','Failed to add new Service Brand');
    }
    public function BrandServices($id)
    {
        $s_brand = $this->s_brand->find($id);
        $results = $s_brand->services()->orderBy('id', 'desc')->paginate(10);
        //$results = $this->s_category_services->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.brand_services_list')
            ->with('s_brand_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }



// Brand's Services

    public function IndexBrandServices()
    {


        $results = $this->s_brand_services->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.brand_services_list')
            ->with('s_brand_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function SearchBrandService(Request $request)
    {
        $keyword = $request->Input('keyword');
        $results = BrandServices::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.brand_services_list')
            ->with('s_brand_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatusBrandService(Request $request)
    {
        $s_brand_services = BrandServices::find($request->input('id'));
        $s_brand_services->active = !$request->input('active');
        if($s_brand_services->save()) {
            return redirect()->back()->with('successMessage', 'Brand Service Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Brand Service');
    }
    public function DestroyBrandService($id)
    {
        $s_brand_services = $this->s_brand_services->find($id);
        if($s_brand_services->delete()) {
            return redirect()->back()->with('successMessage', 'Successfully deleted the Brand Service');
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the Brand Service');
    }
    public function EditBrandService($id)
    {

        $s_brand_service = $this->s_brand_services->find($id);
        if(!$s_brand_service) {
            return redirect()->back()->with('errorMessage', 'Brand\'s service not found');
        }
        return view('admin.services.brand_service_edit', compact('s_brand_service'))
            ->with('s_brands',ServiceBrands::all());
    }
    public function UpdateBrandService($id , Request $request)
    {
        $s_brand_service = BrandServices::find($id);
        if(! $s_brand_service->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.service-brand-services.index')->with('errorMessage', 'Failed to Update Service Brand');
        }
        return redirect()->route('admin.service-brand-services.index')->with('successMessage', 'Successfully Updated the Service Brand');
    }
    public function NewBrandService()
    {
        return view('admin.services.brand_service_new')
            ->with('s_brands',ServiceBrands::all());

    }
    public function AddBrandService(Request $request)
    {

        $s_brand_service = new BrandServices();

        $s_brand_service->s_brand_id = $request->input('s_brand_id');
        $s_brand_service->name = $request->input('name');
        $s_brand_service->price = $request->input('price');
        $s_brand_service->desc = $request->input('desc');

        if($s_brand_service->save()) {
            return redirect()->route('admin.service-brand-services.index')->with('successMessage','Successfully Added new Service Brand');
        }
        return redirect()->route('admin.service-brand-services.index')->with('errorMessage','Failed to add new Service Brand');
    }



// Optional Services
    public function IndexOptionalServices()
    {
        $results = $this->optional_services->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.optional_services_list')
            ->with('optional_services', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page)
            ->with('s_id',"");

    }
    public function SearchOptionalService(Request $request)
    {
        $keyword = $request->Input('keyword');
        $results = OptionalServices::where('name','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();
        return view('admin.services.optional_services_list')
            ->with('optional_services',$results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatusOptionalService(Request $request)
    {
        $optional_service = OptionalServices::find($request->input('id'));
        $optional_service->active = !$request->input('active');
        if($optional_service->save()) {
            return redirect()->back()->with('successMessage', 'Optional Service Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Optional Service');
    }
    public function UpdateOptionalService($id , Request $request)
    {


/*        $s_category = ServiceCategory::find($id);

        if(! $s_category->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.service.categories.index')->with('errorMessage', 'Failed to Update Service Category');
        }

        return redirect()->route('admin.service.categories.index')->with('successMessage', 'Successfully Updated the Service Category');*/


        $optional_service = OptionalServices::find($id);

        if(! $optional_service->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.optional-services.index')->with('errorMessage', 'Failed to Update Optional Service Category');
        }

        return redirect()->route('admin.optional-services.index')->with('successMessage', 'Successfully Updated the Service Category');




/*        $optional_service = OptionalServices::find($request->input('id'));
        $optional_service->active = !$request->input('active');
        if($optional_service->save()) {
            return redirect()->back()->with('successMessage', 'Optional Service Updated Successfully');
        }
        return redirect()->back()->with('errorMessage', 'Failed to Update Optional Service');*/

    }
    public function DestroyOptionalService($id)
    {
        $optional_service = $this->optional_services->find($id);


        if($optional_service->delete()) {
            return redirect()->back()->with('successMessage', 'Successfully deleted Optional Service');
        }
        return redirect()->back()->with('errorMessage', 'Failed to delete the Optional Service ');
    }
    public function EditOptionalService($id)
    {
        $optional_service = $this->optional_services->find($id);
        if(!$optional_service) {
            return redirect()->back()->with('errorMessage', 'Optional Service not found');
        }
        return view('admin.services.optional_service_edit', compact('optional_service'));
    }
    public function NewOptionalService()
    {
        return view('admin.services.optional_service_new');
    }
    public function AddOptionalService(Request $request)
    {
        $optional_service = new OptionalServices();
        $optional_service->name = $request->input('name');
        $optional_service->price = $request->input('price');
        $optional_service->desc = $request->input('desc');

        if($optional_service->save()) {
            return redirect()->route('admin.optional-services.index')->with('successMessage', 'Successfully Added new Optional Service');
        }
        return redirect()->route('admin.optional-services.index')->with('errorMessage', 'Failed to add new Optional Service');
    }





}



