<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index()
    {
        return view('welcome');
    }
    function register()
    {
        return view('register');
    }
    function login(Request $request)
    {
        Session::flash('email', $request->input('email'));
        $request->validate(
            ['email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required'=>'email wajib diisi',
            'password.required'=>'password wajib diisi'
        ]
        );
        $infoLogin = [
            'email' => $request ->email,
            'password' => $request ->password,
        ];

        if (Auth::attempt($infoLogin)) {
            return redirect()->route('home');
        }else{
            return back()->withErrors('username dan password yang dimasukkan tidak sesuai');
        }
    }
}
