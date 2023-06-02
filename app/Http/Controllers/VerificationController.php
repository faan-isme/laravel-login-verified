<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    function notice()
    {
        return view('/verifikasi');
    }

    function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    function resendVerif(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->with('massage', 'Email Verifikasi sudah terkirim!');
    }
}
