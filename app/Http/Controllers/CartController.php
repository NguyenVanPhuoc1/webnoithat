<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart ;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function viewCart(){
        $cartItems = Cart::content();
        $subtotal = $this -> getTotalPrice($cartItems);
        return view('frontend.cart',['cartItems' => $cartItems, 'subtotal' => $subtotal ]);
    }
    public function getTotalPrice($cartItems)
    {
        $totalPrice = 0;

        // Lặp qua các sản phẩm trong giỏ hàng
        foreach ($cartItems as $item) {
            // Tính tổng giá tiền của từng sản phẩm và cộng vào tổng giá tiền
            $totalPrice += $item->price * $item->qty;
        }

        return $totalPrice;
    }
    // add Cart
    public function addCart(Request $request){
        $product = Product::find(intval($request->id));
        $img = $product->images->first()->file_name;
        // var_dump($img);die();
        $pro_qty = 1;
        $price = $product->discount_percent == 0 ? $product->price : intval(($product->price * (100 - intval($product->discount_percent))/ 100));
        Cart::add($product->id,$product->name,$pro_qty,$price,  ['image' => $img]);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
    // xóa sản phẩm

    public function deleteCart($rowId){
        Cart::remove($rowId);
        $totalPrice = $this->getTotalPrice(Cart::content());
        return response()->json(['success' => true, 'totalPrice' => $totalPrice]);
    }

    // hàm update giá tiền
    public function updateCart($rowId)
    {
        $quantity = request('quantity');
        Cart::update($rowId, $quantity);
    
        // Lấy thông tin sản phẩm đã được cập nhật
        $updatedItem = Cart::get($rowId);
    
        // Tính toán giá tiền của sản phẩm đã được cập nhật
        $subtotal = $updatedItem->price * $quantity;
    
        // Tính toán lại tổng giá tiền của giỏ hàng
        $totalPrice = $this->getTotalPrice(Cart::content());
    
        return response()->json([
            'subtotal' => $subtotal,
            'totalPrice' => $totalPrice,
        ]);
    }
}
