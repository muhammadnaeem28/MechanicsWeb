<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 7/11/2016
 * Time: 1:21 AM
 */

namespace App\Http\Controllers\WEB;


class UserController extends Controller
{


    public function index() {

       /* return view('users.customers.dashboard');*/

    }

    public function ProfileUpdate(ProfileRequest $request) {


        $user = User::find(Auth::user()->id);

        $user_name = $request->input('name');

        $user_name = preg_replace('/\s+/','',$user_name);


        if ($request->hasFile('input-file-preview'))
        {
            if(! empty($user->image_url)){
                if(file_exists(public_path() . $user->image_url)){
                    if($user->image_url != "/wb-content/img/default-img.png"){
                        unlink(public_path() . $user->image_url);
                    }



                }
            }

            $image = $request->file('input-file-preview');
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