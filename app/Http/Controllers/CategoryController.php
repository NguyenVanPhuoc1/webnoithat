<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $cateService;

    public function __construct(CategoryRepository $cateService)
    {
        $this->cateService = $cateService;
    }
    public function viewAdminDanhmuc(Request $request){
        try {
            $cateList = $this->cateService->getAll();
            // dd($cateList);die();
            // Lấy tất cả danh mục 
            return view('admin.qlidanhmuc', compact('cateList'));
        } catch (\Exception $e) {
    
            // Trả về lỗi 404 nếu có lỗi xảy ra
            abort(404, 'No get data for news');
        }
    }

    public function deleteCateId($id){
        try{
            return $this->cateService->delete($id);
        } catch (\Exception $e) {
    
            return redirect()->route('category_admin')->with('error','Xóa Không Thành công!');
        }
    }

    public function deleteCateSelectedIds(Request $request){
        try{
            $selectedIds = $request->input('selectedIds', []);
            $this->cateService->deleteSelectedIds($selectedIds);
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
            $updatedCount = $this->cateService->getById($id)->update(['noi_bat' => $noiBatValue]);

            // Kiểm tra nếu không có bản ghi nào được cập nhật
            if ($updatedCount === 0) {
                return response()->json(['error' => 'Không tìm thấy bài viết nào với slug này.'], 404);
            }
            // dd($news);die();
            // Trả về phản hồi thành công
            return response()->json(['success' => 'Cập nhật trạng thái nổi bật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái nổi bật.']);
        } 
    }

    // view page add 
    public function viewPageaddCate(){
        return view('admin.category.create');
    }
    public function addCate(CategoryRequest $request){
        // Thu thập dữ liệu từ request
        $data = $request->all();
        try {
            $this->cateService->createCateData($data);
    
            return redirect()->route('category_admin')->with('success', 'Thêm Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Thêm Thất Bại. Vui lòng thử lại sau.']);
        }
    }
    // view page update 
    public function viewPageupdateCate($id){
        $cate = $this->cateService->getById($id);
        // dd($news);
        return view('admin.category.update',compact('cate'));
    }

    public function updateCate(CategoryRequest $request,$id){
        $data = $request->all();
        // dd($data);die();
        try {
            $this->cateService->updateCateData($data,$id);
    
            return redirect()->route('category_admin')->with('success', 'Sửa Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Sửa Thất Bại. Vui lòng thử lại sau.']);
        }
    }
}
