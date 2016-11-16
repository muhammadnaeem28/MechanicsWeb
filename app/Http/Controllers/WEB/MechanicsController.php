<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 7/13/2016
 * Time: 3:05 AM
 */

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInfoRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use Alert;
use Image;
use Auth;



class MechanicsController extends Controller
{


    public function index() {

    return view('users.mechanics.');

    }




}