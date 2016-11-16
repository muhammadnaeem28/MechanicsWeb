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
//use App\Http\Requests\Request;
use Illuminate\Http\Request;

class HomeController extends  Controller
{
    public function index() {

        return view('users.public.home');
    }

    public function Contact() {

        return view('users.public.contactus');
    }

    public function MechanicJoinUs() {

        //return "asa";

        return view('users.public.mechanic-join-us');
    }

    public function MechanicJoinUsSubmit(Request $request) {

        $mechanic = new User();
        $mechanic->fname = $request->input('fname');
        $mechanic->email = $request->input('email');
        $mechanic->phone1 = $request->input('phone1');
        $mechanic->role= 'mechanic';
        $mechanic->image_url = '/web_content/img/mechanics/default_mechanic.png';


        if($mechanic->save()) {
            alert('Your application has been submitted. We will get back to you. Thank you!')->persistent('Great !');
            return redirect()->route('home.index');
        }
        return redirect()->back();

    }

    public function MechanicsIndex() {

        $mechanics = User::where('role','mechanic')->get();


        return view('users.public.mechanics')
            ->with('mechanics',$mechanics);

    }
    public function MechanicProfile($id,$name) {

/*        $comments = DB::table('comments_experience')
            ->join('users', 'comments_experience.user_id', '=', 'users.id')
            ->select('users.name','users.image_url','comments_experience.comment')
            ->where('comments_experience.ex_id',$id)
            ->get();*/
        $comments = DB::table('m_comments')
                ->join('users', 'm_comments.customer_id', '=', 'users.id')
            ->select('users.fname','users.lname','users.image_url','m_comments.comment','m_comments.rating')
            ->where('m_comments.mechanic_id',$id)
            ->get();
        /*        return $comments;*/

        $mechanic = User::find($id);

        return view('users.public.mechanic_profile')
            ->with('mechanic',$mechanic)
            ->with('comments',$comments)
            ->with('total_comments', count($comments));



    }

    public function Quotation() {

        return view('users.public.quotation');
    }




}