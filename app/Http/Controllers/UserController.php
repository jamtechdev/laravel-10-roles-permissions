<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function perform()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login.show');
    }
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('superadmin')) 
        {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'superadmin');
            })->get();
        } 
        else 
        {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'admin']);
            })->whereNotIn('id', [$user->id])->get();
        }
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.index')->with('message','Add User Successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('name')->toArray();
        $roles = Role::all();
        return view('user.edit',compact('user', 'userRole','roles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $userid = $request->user_id;
        $userdata = User::find($userid);
        $userdata->name = $request->name;
        $userdata->username = $request->username;
        $userdata->email = $request->email;
        $userdata->save();
        $roleid = $request->role;
        if($roleid){
            $userdata->roles()->sync($roleid);
        }
        return redirect()->route('users.index')->with('message','Update User Successfully');
    }

    public function destroy($id)
    {
        $userid = User::find($id);
        $userid->delete();
        return redirect()->route('users.index')->with('message','Delete User successfully');
    }
}