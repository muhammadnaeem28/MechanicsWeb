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
use App\Models\Customers\SQuotations;
use App\Models\Customers\SQuotationServices;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use App\Models\MComment;
use Alert;
use Image;
use Auth;
use App\ContactMessages;
use App\Http\Requests;
use DB;
use App\Http\Requests\CustomerAccountUpdate;

use Validator;

class CustomerControllerAdmin extends Controller
{


    /**
     * @var App\Repositories\User\UserInterface;
     */
    protected $user;

    /**
     * create a new instance
     */
    public function __construct()
    {
        $this->user = new User;
    }

    public function Index()
    {
    /*    return view('admin.customers.customers_list')
            ->with('users', $this->user->where('active','1')->orderBy('id', 'desc')->paginate(10));*/

        $results = $this->user->orderBy('id', 'desc')->where('role','customer')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.customers.customers_list')
            ->with('customers', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }

    public function Search(Request $request)
    {
        $keyword = $request->Input('keyword');

        $customers = User::where('fname','LIKE','%'.$keyword.'%')->paginate(10);
        $current_page_number = $customers->currentPage();
        $items_per_page = $customers->perPage();

        return view('admin.customers.customers_list')
            ->with('customers',$customers)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatus(Request $request)
    {

        $user = User::find($request->input('id'));
        $user->active = !$request->input('active');


        if($user->save()) {
            return redirect()->back()->with('successMessage', 'Customer Updated Successfully');
        }

        return redirect()->back()->with('errorMessage', 'Failed to Update Customer');
    }


    public function Destroy($id)
    {

        $user = $this->user->find($id);


        if($user->delete()) {

            return redirect()->back()->with('successMessage', 'Success deleted user');
        }

        return redirect()->back()->with('errorMessage', 'Failed deleted user');
    }

    public function Edit($id)
    {
        $customer = $this->user->find($id);


        if(! $customer) {
            return redirect()->back()->with('errorMessage', 'Customer not found');
        }

        return view('admin.customers.edit', compact('customer'));
    }


    public function Update($id , CustomerAccountUpdate $request)
    {

        $user = User::find($id);

        if(! $user->update($request->except('_token', '_method'))) {
            return redirect()->route('admin.customer.index')->with('errorMessage', 'Failed update user');
        }

        return redirect()->route('admin.customer.index')->with('successMessage', 'Success update user');
    }




    public function ViewMessages()
    {
        return view('admin.users.messages')
            ->with('messages', ContactMessages::orderBy('id', 'desc')->paginate(10) );
    }
















    public function AccountSettings() {

        $id=Auth::user()->id;
        $user = User::find($id);

        return view('users.customers.account-settings')
            ->with('user',$user);

    }
    public function Help() {

      //  return view('users.customers.Help');

    }

    public function ProfilePictureUpdate(Request $request) {

        $user = User::find(Auth::user()->id);
        $user_name = $user->fname ."-". $user->lname;
        $user_name = preg_replace('/\s+/','',$user_name);

        if ($request->hasFile('input-file-preview'))
        {
            if(! empty($user->image_url)){
                if(file_exists(public_path() . $user->image_url)){
                    if($user->image_url != "/web_content/img/default_img.png"){
                        unlink(public_path() . $user->image_url);
                    }
                }
            }
            $image = $request->file('input-file-preview');
            $filename  =  $user_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();
            $path = public_path('web_content/img/' . $filename);
            Image::make($image->getRealPath())->fit(600, 600)->save($path);
            $user->image_url = '/web_content/img/' . $filename;
        }

        if($user->save()) {
            alert('Your Profile has been Updated.')->persistent('Great !');
            $url = URL::route('customer.account-settings', array('#profile_picture'));
            return redirect($url);
        }

        alert()->error('Error occurred, try again or upload another image', 'Warning')->autoclose(3500);
        $url = URL::route('customer.account-settings', array('#personal_info'));
        return redirect($url);
    }

    public function ChangePassword(ChangePasswordRequest $request){
        $user = User::find(Auth::user()->id);


        $current_password = bcrypt($request->input('current_password'));

        if($user->password==$current_password){

            return $user->password;
            $user->password = bcrypt($request->input('password'));
            alert('Your Password has been changed.')->persistent('Great !');
            $url = URL::route('customer.account-settings', array('#change_password'));
            return redirect($url);
        }

        alert()->error('Error occurred, try again', 'Warning')->autoclose(3500);
        $url = URL::route('customer.account-settings', array('#change_password'));
        return redirect($url);

    }
    public function PersonalInfoUpdate(PersonalInfoRequest $request) {
        /*return "asdasdsa";*/


        $user = User::find($request->input('row_id'));

        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone1 = $request->input('phone1');
        $user->phone2 = $request->input('phone2');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->zip = $request->input('zip');
        $user->biography = $request->input('biography');
        $user->languages = $request->input('languages');

        if($user->save()) {


            alert('Your Profile Picture has been Updated.')->persistent('Great !');
            $url = URL::route('customer.account-settings', array('#personal_info'));
            /*Redirect::to($url);*/
            return redirect($url);
        }
        return redirect()->back();
    }
    public function NewReview($mechanic_id){
        $mechanic = User::find($mechanic_id);
        return view('users.mechanics.review_mechanic')
            ->with('mechanic', $mechanic);
    }

    public function AddReview(Request $request){


        $mcomment = new MComment;
        $mcomment->mechanic_id= $request->input('id');
        $mcomment->customer_id = Auth::user()->id;
        $mcomment->comment= $request->input('comment');

        $mechanic_fname = $request->input('fname');
            $mechanic_lname = $request->input('lname');
        $mechanic_name = $mechanic_fname .'-'. $mechanic_lname ;

        $name = preg_replace('/\s+/','-',$mechanic_name );

        $mcomment->save();
        return redirect()->route('mechanics.profile',['id'=>$request->input('id'),'name'=>$name]);
        //return redirect()->route('mechanics.profile',['id'=>$request->input('eid'),'title'=>$request->input('eid')]);

    }









    //manage customer quotations

    public function QuotationList(){

        $results = DB::table('s_quotations')
            ->leftJoin('users', 's_quotations.customer_id', '=', 'users.id')
            ->leftJoin('c_cars', 's_quotations.car_id', '=', 'c_cars.id')
            ->leftJoin('c_brands', 'c_cars.cb_id', '=', 'c_brands.id')
            ->leftJoin('c_years', 'c_cars.cy_id', '=', 'c_years.id')
            ->leftJoin('c_models_trims', 'c_cars.cm_id', '=', 'c_models_trims.id')
            ->select(
                's_quotations.id as quote_id', 's_quotations.quote_no as quote_number',
                's_quotations.status as status','s_quotations.total_price as total_price',
                'users.id as customer_id','users.fname as fname','users.lname as lname','users.phone1 as phone1','users.phone2 as phone2','users.full_address as full_address',
                'c_cars.id as car_id',
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name',
                'c_cars.total_mileage as total_mileage', 'c_cars.daily_mileage as daily_mileage',
                'c_cars.image_url as image_url',
                's_quotations.total_services as total_services','s_quotations.service1_name as service1_name',
                's_quotations.created_at as created_at'
            )->orderBy('s_quotations.id', 'desc')->paginate(15);



        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.customers.customers_quotations')
            ->with('quotations', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function QuotationEdit($id){

        $quotation = SQuotation::find($id);
        $quotation_services = $quotation->services;

        $vehicle = DB::table('s_quotations')
            ->leftJoin('c_cars', 's_quotations.car_id', '=', 'c_cars.id')
            ->leftJoin('c_brands', 'c_cars.cb_id', '=', 'c_brands.id')
            ->leftJoin('c_years', 'c_cars.cy_id', '=', 'c_years.id')
            ->leftJoin('c_models_trims', 'c_cars.cm_id', '=', 'c_models_trims.id')
            ->select(
                'c_cars.id as car_id',
                'c_brands.id as cb_id', 'c_brands.name as brand_name',
                'c_years.id as cy_id','c_years.name as year_name',
                'c_models_trims.id as cm_id', 'c_models_trims.name as model_name', 'c_models_trims.trim as trim_name'
            )->where('s_quotations.id', $id)->get();


        return view('admin.customers.customers_quotation_services')
            ->with('quotation_services ', $quotation_services )
            ->with('vehicle',$vehicle);


    }
    public function QuotationUpdate(Request $request){
        $quotation = SQuotations::find($request->id);



    }








}