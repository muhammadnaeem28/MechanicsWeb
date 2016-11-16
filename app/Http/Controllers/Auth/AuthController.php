<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;


use Alert;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Auth;


class AuthController extends Controller implements AuthenticateUserListener {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @var App\Repositories\User\UserInterface
     */
    protected $user;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Guard $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }




//Appointment form login and signup

    public function AjaxRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            return Response()->json([
                'message'=>'Errors',
                'Errors'=>$errors
            ]);


        }
        $this->user->fname = $request->input('first_name');
        $this->user->lname = $request->input('last_name');
        $this->user->email = $request->input('email');
        $this->user->image_url  = "/web_content/img/default_img.png";
        $this->user->active  = 1;
        $this->user->password = bcrypt($request->input('password'));


        if($this->user->save()) {

            return Response()->json([
                'message'=>'User registered successfully',
                'user_id'=>$this->user->id,
                'first_name'=>$this->user->fname,
                'last_name'=>$this->user->lname,
                'email'=>$this->user->email,
                'image_url'=>$this->user->image_url,
            ]);

        }

        return Response()->json([
            'message'=>'Failed to register user',
        ]);


    }

    public function AjaxLogin(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            return Response()->json([
                'message'=>'Errors',
                'Errors'=>$errors
            ]);
        }

        $email = $request->input('email');
        $password = $request->input('password');
        if($request->input('remember')==1)
            $remember = true;
        else
            $remember = false;

        if(!$this->auth->attempt(['email' => $email, 'password' => $password],$remember)) {

            return Response()->json([
                'message'=>'Invalid credentials email and password',
            ]);
        }

        return Response()->json([
            'message'=>'User have been logged in',
            'user_id'=>Auth::user()->id,
            'first_name'=>Auth::user()->fname,
            'last_name'=>Auth::user()->lname,
            'email'=>Auth::user()->email,
            'image_url'=>Auth::user()->image_url,
        ]);



    }


    public function AjaxLoggedUser()
    {
        if(!Auth::user()) {
            return Response()->json([
                'code'=>404,
                'message'=>'No user logged in',
            ]);
        }
        return Response()->json([
            'message'=>'logged User Details',
            'user_id'=>Auth::user()->id,
            'first_name'=>Auth::user()->fname,
            'last_name'=>Auth::user()->lname,
            'email'=>Auth::user()->email,
            'image_url'=>Auth::user()->image_url,
        ]);
    }


    public function register()
    {
        return view('users.public.register_customer');
    }

    public function storeRegister(RegisterRequest $request)
    {
        $this->user->fname = $request->input('fname');
        $this->user->lname = $request->input('lname');
        $this->user->email = $request->input('email');
        $this->user->image_url  = "/web_content/img/default_img.png";
        $this->user->active  = 1;
        $this->user->password = bcrypt($request->input('password'));


        if($this->user->save()) {
            alert('Your account has been created, Login now')->persistent('Great !');
            return redirect()->route('auth.login.index');
        }
        alert()->error('Sorry, failed create your account', 'Failed');
        return redirect()->route('register.index');
    }

    public function login()
    {
        return view('users.public.login_customer');
    }
    public function authenticate(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if($request->input('remember')==1)
            $remember = true;
        else
            $remember = false;

        if(!$this->auth->attempt(['email' => $email, 'password' => $password],$remember)) {
            alert()->error('Invalid credentials', 'Warning')->autoclose(3500);
            return redirect()->back();
        }
        alert()->success("You have been logged in", 'Great !')->autoclose(3500);
        if($this->auth->user()->role !== 'admin') {
            return redirect()->route('home.index');        }
//        Session()->flash('url',Request::server('HTTP_REFERER'));


        return redirect()->route('admin.dashboard');
        //return redirect()->back();

        //return redirect()->intended($this->redirectPath());
        //return Redirect::intended('home');
    }
    public function LoginFacebook(){

    }
    public function destroy()
    {
        $this->auth->logout();
        alert()->success('You have been logged out', 'Goodbye !')->autoclose(3500);
        return redirect()->route('home.index');
    }

    public function userHasLoggedIn($user)
    {
        alert()->success("You have been logged through Facebook", 'Great !')->autoclose(3500);

        $data = array('name' => Auth::user()->name);

        Mail::send('public.emails.welcome', $data, function($message) use ($data)
        {
            $message->to(Auth::user()->email, Auth::user()->name)->subject('Welcome to Cityfy!');
        });

        return redirect()->route('home.index');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }






}
