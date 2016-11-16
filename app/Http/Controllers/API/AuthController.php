<?php
namespace App\Http\Controllers\API;
use Validator;
use \App\Models\Cars as Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\CustomerCar;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Authorizer;

/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/21/2016
 * Time: 3:47 PM
 */
class AuthController extends  Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:1',
            'lname' => 'required|min:1',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
/*            return redirect('post/create')
                ->withErrors($validator)
                ->withInput();*/
            $code='422';
            $message='Email invalid or already exists';
            return Response()->json([
                'code' => $code,
                'data' => [
                    'message' => $message
                ]
            ]);
        }

        $user = new \App\User();

        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if($user->save()) {
            $message="Registration successful";
            $code="200";
        }
        else{
            $message="Registration unsuccessful";
            $code="401";
        }
        return Response()->json([
            'code' => $code,
            'data' => [
                'message' => $message
            ]
        ]);

        /*        return Response()->json([
                    'cars' => $this->carTransformer->transformCollection($cars->all())
                ]);*/



    }

    public function login(){

        $message="USer";

        return Response()->json([
            'token' =>Authorizer::issueAccessToken(),
            'data' => [
                'message' => $message
            ]]);
    }

}