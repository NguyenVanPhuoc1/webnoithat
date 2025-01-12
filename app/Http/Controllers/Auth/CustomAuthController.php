<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    //dependency injection
    protected $userService;
    public function __construct(UserRepository $userService)
    {
        $this->userService = $userService;
    }
    // register
    public function createRegister(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request){
        // Thu thập dữ liệu từ request
        $data = $request->all();
        // Gọi phương thức create để thêm người dùng
        try {
            $this->userService->createUser($data);
    
            return redirect('/login')->with('success', 'Đăng Kí Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->withErrors(['error' => 'Đăng Ký Thất Bại. Vui lòng thử lại sau.']);
        }
    }

    // login
    public function createLogin(){
        return view('auth.login');
    }
    // login with email and password
    public function login(LoginRequest $request){
        $request->authenticate();

        // Tạo lại session ID để bảo vệ người dùng khỏi session giả mạo
        $request->session()->regenerate();

        // Kiểm tra xem người dùng có phải là admin không
        if (!Auth::user()->is_admin) {
            // Nếu là admin, chuyển hướng đến trang admin
            return redirect()->route('admin.dashboard')->with('success', 'Đăng Nhập Thành Công.'); 
        }

        // Nếu không phải admin, chuyển hướng về trang chủ
        return redirect()->route('home');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect('/login');
    }
}
