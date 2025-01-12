<?php

namespace App\Services;

use App\Models\User;

class UserRepository extends AbstractCrud
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho user tại đây
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['new-password']) ? bcrypt($data['new-password']) : bcrypt('12345678'), // Mã hóa mật khẩu trước khi lưu
            'is_admin' => 1,//phân quyền 0:admin, 1: người dùng
        ]);
        
    }
}