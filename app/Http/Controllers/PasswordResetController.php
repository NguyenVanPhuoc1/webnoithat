<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    //
    public function showEmailForm()
    {
        return view('userpassword.sendmailotp');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        
        $otp = rand(100000, 999999);
        $email = $request->email;

        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $otp, 'created_at' => Carbon::now()]
        );
        Session::put('email', $email);
        Mail::send('userpassword.otpreset', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Your OTP Code');
        });

        return redirect('/password-reset/otp')->with('email', $email);
    }

    public function showOtpForm()
    {
        return view('userpassword.checkotp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $otp = $request->otp;

        // dd($otp);die();
        $passwordReset = PasswordReset::where('email','=', $email)
            ->where('token','=', $otp)
            ->first();
        if (!$passwordReset) {
            return redirect()->back()->with(['error' => 'The OTP code is incorrect.']);
        }
        // check otp hết thời gian
        if (Carbon::parse($passwordReset->created_at)->addMinutes(10)->isPast()) {
            return redirect()->back()->with(['error' => 'The OTP code has expired.']);
        }

        Session::put('email', $email);
        return redirect('/password-reset/change');
    }

    public function showChangePasswordForm()
    {
        if (!Session::has('email')) {
            return redirect('/password-reset');
        }

        return view('userpassword.userchangepassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|same:password',
        ]);

        $email = Session::get('email');
        $user = User::where('email', $email)->first();

        $user->password = bcrypt($request->password);
        $user->save();

        Session::forget('email');

        return redirect('/login')->with('status', 'Password changed successfully.');
    }
}
