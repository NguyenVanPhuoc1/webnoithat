<?php 
namespace App\Services;

use App\Contracts\EmailSenderInterface;
use Illuminate\Support\Facades\Mail;

class EmailOtp implements EmailSenderInterface
{
    public function send($user, $data): bool
    {
        // Mail::to($user->email)->send(new \App\Mail\OTPVerification($data));
        return true;
    }
}
