<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $adduser = new User();
        $adduser->name = $request->name;
        $adduser->email = $request->email;
        $adduser->username = $request->username;
        $adduser->password = Hash::make($request->password);
        $adduser->save();

        return redirect()->route('login.show')->with('message',' Registration Successfully');
    }
}
