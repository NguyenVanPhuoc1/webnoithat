<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\SignupUserRequest;


class CustomAuthController extends Controller
{
    public function Login(){
        return view('admin.login');
    }

    public function Dashboard(){
        return view('admin.trangchu');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('name','email','password');
        // dd(Auth::attempt($credentials));die();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $id_admin = $user->name;
            $role = $user->role;
            
            session()->put('id_admin', $user);
    
            if ($role == 1) { // Giả sử role 1 là admin
                return redirect()->intended('admin/trang-chu')->withSuccess('Đăng nhập thành công');
            } else { 
                return redirect()->intended('/')->withSuccess('Đăng nhập thành công');
            }
        }
        return redirect('/login')->with('error','Thông tin đăng nhập không chính xác');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('/login');
    }

    // Thay đổi mật khẩu
    public function viewChangePassword(){   
        return view('admin.changepassword');
    }

    public function changePassword(Request $request)
    {   
        $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|string|different:old-password',
            'renew-password' => 'required|string|same:new-password',
        ]);

        $user = User::where('id',session('id_admin')->id)->get();
        // dd(request()->input('old-password'));die();
        if (!Hash::check(request()->input('old-password'), $user[0]['password'])) {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại bạn nhập không đúng');
        }
        $user[0]->update(['password' => bcrypt(request()->input('new-password'))]);
        

        return redirect('admin/changepassword')->withSuccess('Mật khẩu đã được cập nhật thành công');
    }

    // đăng kí tài khoản
    public function signUp(){
        return view('admin.signup');
    }

    public function register(SignupUserRequest $request){
        // dd($request);die();
        // kiểm tra thành công add vào database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->input('new-password')), // Mã hóa mật khẩu trước khi lưu
            'role' => 0,//phân quyền 1:admin, 0: người dùng
        ]);


        return redirect('/login')->with('success', 'User created successfully.');
    }
}
