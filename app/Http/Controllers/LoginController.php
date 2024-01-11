<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        if(Auth::attempt($credentials))
        {
            return redirect()->route('users.dashboard');
        }
        else
        {
            return redirect()->route('login.show')->with('messages','Email And Password Are Incorrect');
        }
    }
}
