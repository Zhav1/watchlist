<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logincontroller extends Controller

{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $ValidateData = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($ValidateData)){
            if(Auth()->user()->role == "user")
            {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }else
                return redirect();
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
