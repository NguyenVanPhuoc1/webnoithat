<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class OTPVerification extends Mailable
{
    public $otp;

    // Constructor nhận OTP cần gửi
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    // Định nghĩa cách xây dựng email
    public function build()
    {
        return $this->view('emails.otp')
                    ->with('otp', $this->otp)
                    ->subject('Your OTP Code');
    }
}
