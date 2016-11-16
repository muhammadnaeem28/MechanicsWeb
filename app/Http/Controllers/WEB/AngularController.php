<?php


namespace App\Http\Controllers\WEB;

use \App\Models\CarBrand as CarBrand;
use App\Http\Controllers\Controller;
use App\Http\Requests\MechanicJoinUsRequest;
use App\Models\CustomerCar;
use App\User;
use Alert;
use DB;
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Authorizer;

class AngularController extends  Controller
{

    public function index(){
        return ['data', 'here'];
    }

    public function serveApp(){
        return view('index');
    }

    public function unsupported(){
        return view('unsupported');
    }


}