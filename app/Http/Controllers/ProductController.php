<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->with('images')->paginate(12);
        return view('frontend.sanpham', ['products' => $products]);
    }

    // xem chi tiết sản phẩm theo id
    public function show(Request $request, $id){
        $url = $request->fullUrl();
        // dd($url);die();
        try {
            $product = Product::find(intval($id));
            $categories = Category::all();
            // dd($id);die();
            if(str_contains($url, 'quanlisanpham') ){
                if (!$product) {
                    abort(404); // Hiển thị trang lỗi 404 (Không tìm thấy)
                }
                return view('admin.crudsanpham',compact('product','categories'));
            }else{
                if (!$product) {
                    abort(404); // Hiển thị trang lỗi 404 (Không tìm thấy)
                }else{
                    //tin tức liên quan
                    $relatedProduct = Product::where('id', '!=', $id)
                    ->where('cate_id', '=' , $product->cate_id)
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
                    // lấy comment
                    $productcomments = $product->comment;
                }
                return view('frontend.chitietsanpham',compact('product','relatedProduct','url', 'productcomments'));
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Xử lý ngoại lệ khi không tìm thấy sản phẩm
            abort(404); // Hiển thị trang lỗi 404 (Không tìm thấy)
        }

    }

    public function indexAdmin(Request $request)
    {
        $url = $request->fullUrl();
        $categories = Category::all();
        if(str_contains($url, 'keyword')){
            $keyword = $request->input('keyword');
            $cate_id = $request->input('cate_id');
            if($cate_id == '0'){
                $productsList = Product::where('name', 'like', '%' . $keyword . '%')->orderBy('created_at', 'desc')->paginate(12);
            }else{
                $productsList = Product::where('name', 'like', '%' . $keyword . '%')->where('cate_id', '=' , intval($cate_id) )->orderBy('created_at', 'desc')->paginate(12);
            }
            // dd($keyword);
            
        }else{
            $productsList = Product::orderBy('created_at', 'desc')->paginate(12);
        }
        // dd( $productsList);
        return view('admin.qlisanpham', ['productsList' => $productsList], ['categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.crudsanpham', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        // kiểm tra
        $request->validate([
            'product_name' => 'required|max:500|unique:product,name',
            'cate_id' => 'required|integer|max:100',
            'product_price' => 'required|integer|min:0',
            'discount_percent' => 'required|integer|min:0|max:50'
        ]);
        $productDesc = strip_tags($request->input('product_desc'));
        // Xử lý lưu thông tin sản phẩm vào bảng product
        $product = Product::create([
            'name' => $request->product_name,
            'cate_id' => $request->cate_id,
            'price' => $request->product_price,
            'discount_percent' => $request->discount_percent,
            'description' => $productDesc,
            'noi_bat' => 1,
        ]);
        // Xử lý lưu các file ảnh vào bảng images, liên kết với sản phẩm mới được tạo
        if ($request->file('images') ) {
            foreach ($request->file('images') as $file) {
                // file_name sẽ tạo thêm một chuỗi dựa trên thời gian hiện tại, để tránh việc trùng tên file làm chúng bị ghi đè
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('front/public/image/'), $fileName);

                // thêm các ảnh vào database
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_name' => $fileName
                ]);
            }
        }else {
                // Nếu không có ảnh được tải lên, gán ảnh mặc định
                $fileName = 'noimage.png'; // Thay đổi tên file ảnh mặc định của bạn
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_name' => $fileName
                ]);
            }
        return redirect('/admin/quanlisanpham');
    }

    private function addWatermarkToImage($id, $originalFileName)
    {
        $product = Product::findOrFail($id);
    
        // Thư mục chứa ảnh đã được đóng dấu
        $watermarkedImageDirectory = public_path("front/public/image/");
    
        // Tạo tên mới cho ảnh đã được đóng dấu
        $newFileName = 'markImage_' . $originalFileName;
    
        // Đường dẫn tới ảnh đã được đóng dấu
        $watermarkedImagePath = $watermarkedImageDirectory . $newFileName;
    
        // Tạo ảnh đã được đóng dấu
        $img = Image::make(public_path("front/public/image/{$originalFileName}"));
        $img->insert(public_path('front/public/image/logo_web.png'), 'bottom-right', 10, 10);
        $img->save($watermarkedImagePath);
    
        return $newFileName;
    }

    // public function edit($id)
    // {
    //     $product = Product::with('images')->findOrFail($id);
    //     $categories = Category::all();
    //     return view('admin.crudsanpham', compact('product', 'categories'));
    // }

    public function store(Request $request)
    {
        // dd($request->hasFile('images'));
        $productDesc = strip_tags($request->input('product_desc'));

        // Lấy ID từ request
        $id = $request->input('product_id');
        
        $request->validate([
            'product_name' => 'required|max:500',
            'cate_id' => 'required|integer|max:100',
            'product_price' => 'required|integer|min:0',
            'discount_percent' => 'required|integer|min:0|max:50',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $product = Product::findOrFail($id)
        ->update([
            'name' => $request->product_name,
            'cate_id' => $request->cate_id,
            'description' => $productDesc,
            'price' => $request->product_price,
            'discount_percent' => $request->discount_percent,
        ]);


        // Xử lý lưu các file ảnh vào bảng images, liên kết với sản phẩm mới được tạo
        if ($request->file('images')) {
            // Xóa các hình ảnh cũ có cột product_id = $id trước khi thêm ảnh mới
            ProductImage::where('product_id', $id)->delete();
            foreach ($request->file('images') as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('front/public/image/'), $fileName);

                ProductImage::create([
                    'product_id' => $id,

                    // file_name sẽ tạo thêm một chuỗi dựa trên thời gian hiện tại, để tránh việc trùng tên file làm chúng bị ghi đè
                    'file_name' => $fileName
                    // Thêm các trường thông tin khác của ảnh
                ]);
            }
        }
        return redirect('admin/quanlisanpham');
    }

    //xóa sản phẩm
    public function deleteProducts(Request $request){
        $type = $request->input('delete_type', 'single');

        if($type == 'single'){
            // Xóa một sản phẩm
            $id = $request->input('selected_ids')[0];
            $this->destroy($id);
        } elseif ($type == 'multiple') {
            // Xóa nhiều sản phẩm(nếu có các selected_ids được chọn)
            $selectedIds = $request->input('selected_ids', []);

            if (!empty($selectedIds)) {
                // Xóa từng sản phẩm một
                foreach ($selectedIds as $id) {
                    $this->destroy($id);
                }
            }
        } elseif ($type == 'all') {
            // Xóa tất cả bài viết
            Product::truncate(); 
            // Lấy danh sách các ID hình ảnh liên quan đến sản phẩm
            $imageIdsToDelete = Image::whereNotNull('product_id')->pluck('id')->toArray();

            // Xóa bản ghi hình ảnh liên quan đến sản phẩm
            Image::whereNotNull('product_id')->delete();

            // Xóa tất cả ảnh từ thư mục lưu trữ
            $imageDirectory = 'front/public/image/';
            foreach ($imageIdsToDelete as $imageId) {
                Storage::delete($imageDirectory . $imageId);
            }
        } else {
            abort(404);
        }

        return redirect('/admin/quanlisanpham')->withSuccess('Xóa Thành công!');
    }

    public function destroy($id)
    {

        // Lấy thông tin sản phẩm cần xóa
        $product = Product::findOrFail($id);

        // Lấy danh sách các ảnh liên quan đến sản phẩm
        $images = $product->images()->where('file_name', '!=', 'noimage.png')->get();;

        // Xóa các ảnh từ thư mục lưu trữ
        foreach ($images as $image) {
            File::delete('front/public/image/' . $image->file_name);
        }

        // Xóa các bản ghi ảnh từ cơ sở dữ liệu
        $product->images()->delete();

        // Xóa sản phẩm
        $product->delete();

        return redirect('admin/quanlisanpham')->with('success', 'Sản phẩm đã được xóa thành công');
    }

     // checkbox nổi bật
    public function checkNoiBat(Request $request, $id){
        try {
            $product = Product::findOrFail(intval($id));
            // dd($product);die();
            if($request->input('noi_bat') == 'true'){
                $product->noi_bat = 1;// Nếu không có giá trị, đặt mặc định là false
            }else{
                $product->noi_bat = 0;// Nếu không có giá trị, đặt mặc định là false
            }
            $product->save();
            // dd($news);die();
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Cập nhật trạng thái nổi bật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái nổi bật.']);
        } 
    }
}
