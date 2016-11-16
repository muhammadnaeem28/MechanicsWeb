<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 7/8/2016
 * Time: 3:31 PM
 */

namespace App\Http\Controllers\WEB;

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


class CustomerController extends Controller
{


    public function index() {

        return view('users.customers.dashboard');

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


}