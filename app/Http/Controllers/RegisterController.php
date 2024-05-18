<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){

        return view('login.register');
    }

    public function store(Request $request )
    {
        $ValidateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        User::create($ValidateData);

        // $request->session()->flash('success','Registration successfull!');

        return redirect('/login');
    }
}
