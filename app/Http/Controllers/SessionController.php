<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    function create(Request $request)
    {
        Session::flash('name', $request->input('name'));
        Session::flash('email', $request->input('email'));
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:8'
            ],[
                'name.required'=>'Nama wajib diisi',
                'email.required'=>'Email wajib diisi',
                'email.email'=>'Format email salah atau tidak valid',
                'email.unique'=>'Email sudah digunakan, silahkan masukkan email yang lain',
                'password.required'=>'Password wajib diisi',
                'password.min'=>'Minimum password 8 karakter'
            ]
        );
        
        
        $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
        ];
        $user = User::create($data);

        event(new Registered($user));
        
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        Auth::attempt($infologin);
        return redirect()->route('verification.notice')->with('succes', 'Akun berhasil di buat');


    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
