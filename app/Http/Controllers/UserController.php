<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use Route;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where("users.status", "<>", 2)
                ->paginate(100);
        $users->setPath(Route::currentRouteAction());
        return view('users/index', array("users" => $users));
    }

    public function _new()
    {
        return view('users/add');
    }

    public function _edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('users/edit',["user"=>$user]);
    }

    public function add(Request $request){
        $data = array();
        $data["name"] = $request->input("name");
        $data["email"] = $request->input("email");
        $data["password"] = $request->input("password");

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/new?err=1')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name=$data["name"];
        $user->email=strtolower($data["email"]);
        $user->status=1;
        $user->password=bcrypt($data["password"]);
        $user->save();

        return redirect("admin/users");
    }

    public function edit(Request $request){
        $data = array();
        $id=$request->input("id");
        $data["name"] = $request->input("name");
        $data["email"] = $request->input("email");
        $data["password"] = $request->input("password");

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/new?err=1')->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name=$data["name"];
        $user->email=strtolower($data["email"]);
        $user->save();

        return redirect("admin/users/{$id}");
    }

    public function delete(Request $request)
    {
        $id=$request->input("id");
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }

}
