<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserController extends Controller
{
    public function viewPageUser(){
        
        $userList = DB::table('users')
                ->select('id', 'name', 'email')
                ->where('users.is_admin', 1)
                ->orderBy('created_at','desc')
                ->paginate(50);
        return view('admin.qlinguoidung',compact('userList'));
    }
}
