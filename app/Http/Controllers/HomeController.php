<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\CustomAuthController;
use Illuminate\Support\Facades\Session;
use App\Services\ProductRepository;

class HomeController extends Controller
{
    public function viewHome(){
        //nếu là admin cho đăng xuất
        if(Auth::user()){
            if(!Auth::user()->is_admin){
                Session::flush();
                Auth::logout();
            }
        }
        $category = $this->getCategory();
        return view('frontend.trangchu',compact('category'));
    }

     // lấy tất cả các danh mục
    public function getCategory(){
        $category = Category::orderBy('created_at', 'desc')
        ->where('noi_bat', true) 
        ->get();
        return $category;
    }

    public function getProductbyCate($categoryId){
        try{
            $lang = session()->get('locale', 'vi');
            $products = ProductRepository::getAllProductbyCate($categoryId, $lang);
            return response()->json(['products' => $products], 200);
        }catch(\Exception $e){
            return response()->json('có lỗi ', 400);

        }
    }
    public function searchProduct(Request $request){
        $keyword = $request->input('searchProduct') != null ? $request->input('searchProduct') : '';
        try{
            $lang = session()->get('locale', 'vi');
            $products = ProductRepository::searchProduct($keyword, $lang);
            // dd($products);die();
            return view('frontend.sanpham', compact('products'));
        }catch(\Exception $e){
            return abort(404);

        }
    }

}
