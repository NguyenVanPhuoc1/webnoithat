<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\CategoryRepository;
use App\Services\ProductRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $productService;


    public function __construct(ProductRepository $productService)
    {
        $this->productService = $productService;
    }
    public function viewAdminProduct(){
        try {
            $productList = $this->productService->getAllProduct();
            // dd($productList);die();
            // Lấy tất cả danh mục 
            return view('admin.qlisanpham', compact('productList'));
        } catch (\Exception $e) {
    
            // Trả về lỗi 404 nếu có lỗi xảy ra
            abort(404, 'No get data for news');
        }
    }
     // view page add 
    public function viewPageaddProduct(){
        $categories = CategoryRepository::baseQuery()->get();
        // dd($categories);die();
        return view('admin.product.create',compact('categories'));
    }

    public function addProduct(ProductRequest $request){
        if ($request->hasFile('files')) {
            $data = $request->all();
            // dd($data);die();
            $this->productService->createProductData($data);
            try {
        
                return redirect()->route('product_admin')->with('success', 'Thêm Thành Công.');
            } catch (\Exception $e) {
                // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
                return redirect()->back()->with(['error' => 'Thêm Thất Bại. Vui lòng thử lại sau.']);
            }
        }
        return redirect()->back()->with(['error' => 'Ảnh sản phẩm không được để trống!']);
    }

    // view page update 
    public function viewPageupdateProduct($id){
        $product= $this->productService->getDetail($id);
        $categories = CategoryRepository::baseQuery()->get();
        // dd($product);
        return view('admin.product.update',compact('product','categories'));
    }

    //xóa ảnh của sản phẩm(1 ảnh)
    public function deleteFileImage(Request $request){
        $data = $request->all();
        $this->productService->deleteFileImage($data);
        // try {
        //     return  response()->json(['success','Xóa Thành công!'],200);
        // } catch (\Exception $e) {
        //     // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
        //     return  response()->json(['error','Xóa Không Thành công!'],500);
        // }
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $product = $this->productService->getById($id);
        $data = $request->all();
        $now = Carbon::now();

        if (!$this->productService->checkImage($product) && !$request->hasFile('files')) {
            return redirect()->back()->with(['error' => 'Ảnh sản phẩm không được để trống!']);
        }

        // Thêm ảnh sản phẩm nếu có file input
        if ($request->hasFile('files')) {
            $this->productService->addImageProduct($data, $product, $now);
        }

        // Cập nhật thông tin sản phẩm
        $this->productService->updateProductData($data, $product);

        return redirect()->route('product_admin')->with('success', 'Sửa Thành Công.');
    }
    //xóa theo id
    public function deleteProductId($id){
        try{
            $this->productService->delete($id);
            return redirect()->route('product_admin')->with('success','Xóa Thành công!');
        } catch (\Exception $e) {
    
            return redirect()->route('product_admin')->with('error','Xóa Không Thành công!');
        }
    }
    //xóa theo danh sách id
    public function deleteProductSelectedIds(Request $request){
        try{
            $selectedIds = $request->input('selectedIds', []);
            $this->productService->deleteSelectedIds($selectedIds);
            return  response()->json(['success','Xóa Thành công!'],200);
        } catch (\Exception $e) {
    
            return response()->json( ['error','Xóa Không Thành công!'],400);
        }
    }

    // checkbox nổi bật trả về response()->json dùng cho ajax
    public function checkNoiBat(Request $request, $id){
        try {
            $noiBatValue = $request->input('noi_bat') === 'true' ? true : false;

            // Cập nhật tất cả các bài viết có slug trùng khớp
            $updatedCount = $this->productService->getById($id)->update(['noi_bat' => $noiBatValue]);

            // Kiểm tra nếu không có bản ghi nào được cập nhật
            if ($updatedCount === 0) {
                return response()->json(['error' => 'Không tìm thấy sản phẩm.'], 404);
            }
            // dd($news);die();
            // Trả về phản hồi thành công
            return response()->json(['success' => 'Cập nhật trạng thái nổi bật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái nổi bật.'], 500);
        } 
    }

    // lấy chi tiết thông tin sản phẩm

    public function getDetailProductbySlug(Request $request,$slug){
        try{
            $url = $request->fullUrl();
            $product = $this->productService->getDetailBySlug($slug);
            $relatedProduct = $this->productService->getRelatedProduct($product->id, $product->category['cate_id']);
            // dd($product, $relationProduct);
            return view('frontend.chitietsanpham',compact('product', 'relatedProduct','url'));
        }catch(\Exception $e){
            return abort(404);
        }
    }

}
