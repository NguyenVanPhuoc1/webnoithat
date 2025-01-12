<?php

namespace App\Http\Controllers\PurchaseProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\ProductRepository;

class CartController extends Controller
{
    protected $productService;

    public function __construct(ProductRepository $productService)
    {
        $this->productService = $productService;
    }

    // Hiển thị giỏ hàng
    public function viewCart()
    {
        try{
            $cartItems = Cart::content();
            // dd($cartItems);     
            // Tính tổng giá tiền chỉ một lần
            $subtotal = self::getTotalPrice();
    
            return view('frontend.cart', ['cartItems' => $cartItems, 'subtotal' => $subtotal]);
        }
        catch( \Exception $e){
            return abort(404);
        }
    }

    public static function getTotalPrice(){
        $subtotal = Cart::content()->reduce(function ($total, $item) {
            return $total + ($item->price * $item->qty);
        }, 0);
        return $subtotal;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addCart(Request $request)
    {
        $product = $this->productService->getProductstoCart($request->input('id'));
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        $img = $product->product_image ?? ''; // Đảm bảo xử lý trường hợp không có hình ảnh
        $pro_qty = 1;
        $price = $product->discount_percent == 0 
            ? $product->price 
            : $product->price * (1 - ($product->discount_percent / 100));

        Cart::add($product->id, $product->product_name, $pro_qty, $price, ['image' => $img]);
        // dd(Cart::content());die();
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteCart($rowId)
    {
        Cart::remove($rowId);

        // Tính toán lại tổng giá tiền một cách hiệu quả
        $totalPrice = Cart::content()->reduce(function ($total, $item) {
            return $total + ($item->price * $item->qty);
        }, 0);

        return response()->json(['success' => true, 'totalPrice' => $totalPrice],200);
    }

    // Cập nhật giỏ hàng
    public function updateCart($rowId)
    {
        $quantity = request('quantity');
        Cart::update($rowId, $quantity);

        // Lấy thông tin sản phẩm đã được cập nhật
        $updatedItem = Cart::get($rowId);

        // Tính toán lại giá tiền cục bộ
        $subtotal = $updatedItem->price * $updatedItem->qty;

        // Tính toán tổng giá tiền toàn bộ giỏ hàng
        $totalPrice = Cart::content()->reduce(function ($total, $item) {
            return $total + ($item->price * $item->qty);
        }, 0);

        return response()->json([
            'subtotal' => $subtotal,
            'totalPrice' => $totalPrice,
        ], 200);
    }
    //hủy giỏ hàng
    public static function destroyCart(){
        Cart::destroy();
    }
}
