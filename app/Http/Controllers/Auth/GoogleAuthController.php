<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    //dependency injection
    protected $userService;
    public function __construct(UserRepository $userService)
    {
        $this->userService = $userService;
    }

    // Redirect tới Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback sau khi Google xác thực
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            // Kiểm tra xem người dùng đã tồn tại trong database chưa
            $user = User::where('email', $googleUser->getEmail())->first();
            // dd($user);
            if (!$user) {
                $data = [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('12345678'), // Mã hóa mật khẩu trước khi lưu
                    'is_admin' => 1,//phân quyền 0:admin, 1: người dùng
                ];
                // Nếu chưa tồn tại, tạo tài khoản mới
                $this->userService->createUser($data);
            }
    
            // Đăng nhập người dùng
            Auth::login($user);
    
            // Tạo lại session ID
            session()->regenerate();
    
            return redirect()->route('home')->with('success', 'Đăng nhập thành công.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập bằng Google thất bại. Vui lòng thử lại.');
        }
    }
}