<?php

namespace App\Contracts;

interface EmailSenderInterface
{
    public function send($user, $data): bool;  // gửi email cho người dùng
}
