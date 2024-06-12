<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        // dd(Socialite::driver('google')->redirect());die();
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            session()->put('id_admin',$existingUser);
            Auth::login($existingUser);
        } else {
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            // tạo mật khẩu ngẫu nhiên
            $newUser->password = bcrypt('123456');
            $newUser->role = 0;
            $newUser->save();

            Auth::login($newUser);
            session()->put('id_admin',$newUser);
        }

        return redirect()->route('index');
    }
}
