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
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use App\Models\MComment;
use Alert;
use Image;
use Auth;
use App\ContactMessages;
use App\Http\Requests;

use App\Http\Requests\mechanicAccountUpdate;

use Validator;

class MechanicControllerAdmin extends Controller
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
    /*    return view('admin.mechanics.mechanics_list')
            ->with('users', $this->user->where('active','1')->orderBy('id', 'desc')->paginate(10));*/

        $results = $this->user->orderBy('id', 'desc')->where('role','mechanic')->paginate(10);
        $current_page_number = $results->currentPage();
        $items_per_page = $results->perPage();

        return view('admin.mechanics.mechanics_list')
            ->with('mechanics', $results)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }


    public function Search(Request $request)
    {
        $keyword = $request->Input('keyword');

        $mechanics = User::where('fname','LIKE','%'.$keyword.'%')->where('role','mechanic')->paginate(10);
        $current_page_number = $mechanics->currentPage();
        $items_per_page = $mechanics->perPage();

        return view('admin.mechanics.mechanics_list')
            ->with('mechanics',$mechanics)
            ->with('current_page_number',$current_page_number)
            ->with('items_per_page',$items_per_page);

    }
    public function UpdateStatus(Request $request)
    {

        $user = User::find($request->input('id'));
        $user->active = !$request->input('active');


        if($user->save()) {
            return redirect()->back()->with('successMessage', 'Mechanic Updated Successfully');
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
        $mechanic = $this->user->find($id);


        if(! $mechanic) {
            return redirect()->back()->with('errorMessage', 'mechanic not found');
        }

        return view('admin.mechanics.edit', compact('mechanic'));
    }


    public function Update($id , Request $request)
    {


        $validator = Validator::make($request->all(), [

            'fname' => 'required|min:1',
            'email' => 'required|email|unique:users,id',
            'phone1' => 'required|min:9',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
            'address' => 'required'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();

            return redirect()->back()
            ->withErrors($validator)
                ->withInput();

        /*return Response()->json([
            'message'=>'Errors',
            'Errors'=>$errors
        ]);*/


        }

        $mechanic = User::find($id);

        $mechanic->fname = $request->input('fname');
        $mechanic->lname = $request->input('lname');

        $mechanic_name = $request->input('fname') . "_". $request->input('lname');
        $mechanic_name = preg_replace('/\s+/','_',$mechanic_name);

        $mechanic->email = $request->input('email');
        $mechanic->phone1 = $request->input('phone1');
        $mechanic->phone2 = $request->input('phone2');
        $mechanic->address = $request->input('address');

        $mechanic->m_password = $request->input('password');
        $mechanic->password = bcrypt($request->input('password'));


        if ($request->hasFile('mechanic_image')) {

            if(!empty($mechanic->image_url)){
                if(file_exists(public_path() . $mechanic->image_url)){
                    if($mechanic->image_url != "/web_content/img/default_mechanic.png"){
                        unlink(public_path() . $mechanic->image_url);
                    }



                }
            }
            $image = $request->file('mechanic_image');
            $filename  =  $mechanic_name .'-' . str_random(4) . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'web_content/img/mechanics/'; // upload path
            //$extension = $request->file('brand_image')->getClientOriginalExtension(); // getting image extension
            // $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('mechanic_image')->move($destinationPath, $filename); // uploading file to given path
            $mechanic->image_url = '/web_content/img/mechanics/' . $filename;
        }



        if($mechanic->save()) {
            return redirect()->route('admin.mechanic.index')->with('successMessage', 'Successfully updated the mechanic.');
        }
        return redirect()->route('admin.mechanic.index')->with('errorMessage', 'Failed to update the mechanic.');

    }










}