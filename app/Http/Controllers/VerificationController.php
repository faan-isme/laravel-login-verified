<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
}
