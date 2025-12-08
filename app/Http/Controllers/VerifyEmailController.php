<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function showVerify()
    {
        return view('auth.verify');
    }

    public function verifyRequest(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function reSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return view('auth.verify-send')->with('resent', true);
    }
}
