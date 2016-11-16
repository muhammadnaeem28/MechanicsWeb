<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;


/*use App\Repositories\User\UserInterface;*/

class UserController extends Controller
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

	public function index(Request $request)
	{
/*        $users = $this->user->orderBy('id', 'desc')->paginate(5);
        return $users->;*/

            /*return $users;*/
        /*return $request->Input('i');*/
        
                $results = $this->user->orderBy('id', 'desc')->paginate(10);
        $current_page_number = $results->currentPage();
                $items_per_page = $results->perPage();

        return view('admin.users.index')
                ->with('users', $results)
                ->with('current_page_number',$current_page_number)
                ->with('items_per_page',$items_per_page);

/*
		return view('admin.users.index')
            ->with('users', )
            ->with('i', $request->Input('i'));
*/


	}
    public function search(Request $request)
    {

        $keyword = $request->Input('keyword');

        $users = User::where('name','LIKE','%'.$keyword.'%')->paginate(10);

        /*$users->setPath('search');*/


        return view('admin.users.index')
            ->with('users',$users);

        /*view('admin.users.index')->with('users', $this->user->orderBy('id', 'desc')->paginate(5))*/
/*
            ->with('keyword',$keyword)
            ->with('category',Category::find(Input::get('category_id')));*/

    }
	public function updateStatus(Request $request)
	{

        $user = User::find($request->input('id'));
        $user->active = !$request->input('active');

        /*return $request->input('active');*/
/*		$active = !$request->input('active');
		$id  	= $request->input('id');*/
        
		if($user->save()) {
			return redirect()->back()->with('successMessage', 'Success update status');
		}

		return redirect()->back()->with('errorMessage', 'Failed update status');
	}

	public function destroy($id)
	{

        $user = $this->user->find($id);


		if($user->delete()) {

			return redirect()->back()->with('successMessage', 'Success deleted user');
		}

		return redirect()->back()->with('errorMessage', 'Failed deleted user');
	}

	public function edit($id)
	{
		$user = $this->user->find($id);

            /*return $user;*/
		if(! $user) {
			return redirect()->back()->with('errorMessage', 'User not found');
	}

		return view('admin.users.edit', compact('user'));
	}

	public function update($id , Request $request)
	{
        $user = User::find($id);
        /*return $request->all();*/

		/*if(! $this->user->update($id,$request->all())) {*/
		if(! $user->update($request->except('_token', '_method'))) {
			return redirect()->route('admin.users.index')->with('errorMessage', 'Failed update user');
		}

		return redirect()->route('admin.users.index')->with('successMessage', 'Success update user');
		
	}


}