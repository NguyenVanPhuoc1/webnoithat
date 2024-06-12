<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function viewCategory(){
        $category = Category::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.qlidanhmuc', compact('category'));
    }
    //xem chi tiết
    public function viewDetailCate($id){
        $cate = Category::find($id);
        // dd($news);die();
        if (!$cate) {
            abort(404); // Hiển thị trang lỗi 404 (Không tìm thấy)
        }
        return view('admin.cruddanhmuc',compact('cate'));
    }

    //hàm xem trang thêm mới 
    public function viewPageaddCate(){
        return view('admin.cruddanhmuc');
    }

    //hàm thêm mới danh mục
    //tạo data dữ liệu
    public function create(array $data)
    {
        return Category::create([
            'cate_name' => $data['cate_name'],
            'noi_bat' => true,
        ]);
    }     
    //thêm danh mục
    public function AddCate(Request $request)
    { 
        $request->validate([
            'cate_name' => 'required|max:100|unique:category,cate_name',
        ]);
        $data = $request->all();
        $cate = $this->create($data);
        return redirect('/admin/quanlidanhmuc')->withSuccess('Thêm Thành công!');
    }

    //sửa danh mục
    public function updateCate(Request $request){
        // Lấy ID từ request
        $cateId = $request->input('cate_id');
        // Kiểm tra xem danh mục có tồn tại không

        $cate = Category::find($cateId); 
        if($cate){
            $request->validate([
                'cate_name' => 'required|max:100',
            ]);
            $cate->cate_name = $request->input('cate_name');
            $cate->save();
        }
        return redirect('/admin/quanlidanhmuc')->withSuccess('Sửa Thành công!');
    }

    //xóa danh mục
    public function deleteCate(Request $request)
    {
        $type = $request->input('delete_type', 'single');

        if ($type == 'single') {
            $id = $request->input('selected_ids')[0];
            $category = Category::findOrFail($id);

            if ($category->products()->count() > 0) {
                return redirect('/admin/quanlidanhmuc')->with('error','Không thể xóa danh mục vì có sản phẩm thuộc về nó.');
            }

            $category->delete();
        } elseif ($type == 'multiple') {
            $selectedIds = $request->input('selected_ids', []);

            foreach ($selectedIds as $id) {
                $category = Category::findOrFail($id);

                if ($category->products()->count() > 0) {
                    return redirect('/admin/quanlidanhmuc')->with('error','Không thể xóa danh mục vì có sản phẩm thuộc về nó.');
                }

                $category->delete();
            }
        } elseif ($type == 'all') {
            $categories = Category::all();

            foreach ($categories as $category) {
                if ($category->products()->count() > 0) {
                    return redirect('/admin/quanlidanhmuc')->with('error','Không thể xóa danh mục vì có sản phẩm thuộc về nó.');
                }
            }

            Category::truncate();
        } else {
            abort(404);
        }

        return redirect('/admin/quanlidanhmuc')->with('success', 'Xóa thành công!');
    }

    public function deleteCatebyId($id)
    {
        $category = Category::findOrFail($id);

        if ($category->products()->count() > 0) {
            return redirect('/admin/quanlidanhmuc')->with('error','Không thể xóa danh mục vì có sản phẩm thuộc về nó.');
        }

        $category->delete();
        return redirect('/admin/quanlidanhmuc')->with('success', 'Xóa thành công!');
    }

    // checkbox nổi bật
    public function checkNoiBat(Request $request, $id){
        try {
            $cate = Category::findOrFail(intval($id));
            // dd($cate->noi_bat);die();
            if($request->input('noi_bat') == 'true'){
                $cate->noi_bat = 1;// Nếu không có giá trị, đặt mặc định là false
            }else{
                $cate->noi_bat = 0;// Nếu không có giá trị, đặt mặc định là false
            }
            $cate->save();
            // dd($cate);die();
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Cập nhật trạng thái nổi bật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái nổi bật.']);
        } 
    }
}
