<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CustomerNotification extends Mailable
{
    public $data;

    // Constructor nhận thông báo
    public function __construct($data)
    {
        $this->data = $data;
    }

    // Định nghĩa cách xây dựng email
    public function build()
    {
        return $this->subject('Thông Báo Khách Hàng')
                    ->view('emails.notification')
                    ->with('data', $this->data);
    }
}
