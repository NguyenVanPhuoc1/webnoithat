<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolicyRequest;
use Illuminate\Http\Request;
use App\Services\PoliRepository;
use App\Models\Policy;
use App\Models\PolicyTranslation;


class PolicyController extends Controller
{
    protected $poliService;

    public function __construct(PoliRepository $poliService)
    {
        $this->poliService = $poliService;
    }

    public static function getLoadedPoli($languageCode){
        return PoliRepository::baseQuery()
        ->where('policy_translations.language_code', $languageCode)
        ->orderBy('policy.created_at', 'desc')
        ->take(5)
        ->get();
    }

    public function viewAdminChinhSach(Request $request){
        try {
            $url = $request->fullUrl();
            
            if (str_contains($url, 'keyword')) {
                // Kiểm tra và validate dữ liệu đầu vào
                $request->validate([
                    'keyword' => 'required|max:100',
                ]);
                
                $keyword = $request->input('keyword');
                // Lấy danh sách các chính sách từ từ khóa
                $policysList = $this->poliService->getAllPolibyKeyword($keyword);
            } else {
                // Lấy tất cả chính sách nếu không có từ khóa
                $policysList = $this->poliService->getAllPolicy();
            }
            // dd($policysList);die();
            // Trả về view với danh sách chính sách
            return view('admin.qlichinhsach', compact('policysList'));
        } catch (\Exception $e) {
    
            // Trả về lỗi 404 nếu có lỗi xảy ra
            abort(404, 'No get data for policy');
        }
    }

    public function deletePoliId($id){
        try{
            $this->poliService->delete($id);
            return redirect()->route('poli_admin')->with('success','Xóa Thành công!');
        } catch (\Exception $e) {
    
            return redirect()->route('poli_admin')->with('error','Xóa Không Thành công!');
        }
    }

    public function deletePoliSelectedIds(Request $request){
        // return response()->json($selectedSlugs,200);
        try{
            $selectedIds = $request->input('selectedIds', []);
            $this->poliService->deleteSelectedIds($selectedIds);
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
            $updatedCount = $this->poliService->getById($id)->update(['noi_bat' => $noiBatValue]);

            // Kiểm tra nếu không có bản ghi nào được cập nhật
            if ($updatedCount === 0) {
                return response()->json(['error' => 'Không tìm thấy bài viết nào với slug này.'], 404);
            }
            // dd($policy);die();
            // Trả về phản hồi thành công
            return response()->json(['success' => 'Cập nhật trạng thái nổi bật thành công.'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái nổi bật.']);
        } 
    }

    // view page add 
    public function viewPageaddPolicy(){
        return view('admin.policy.create');
    }
    public function addPolicy(PolicyRequest $request){
        // Thu thập dữ liệu từ request
        $data = $request->all();
        try {
            $this->poliService->createPolicyData($data);
    
            return redirect()->route('poli_admin')->with('success', 'Thêm Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Thêm Thất Bại. Vui lòng thử lại sau.']);
        }
    }
    // view page update 
    public function viewPageupdatePolicy($id){
        try {
            $policy = $this->poliService->getDetail($id);
            // dd($policy);
            return view('admin.policy.update',compact('policy'));
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            abort(404, 'No get data for policy');
        }
    }

    public function updatePolicy(PolicyRequest $request,$id){
        $data = $request->all();
        // dd($data);die();
        try {
            $this->poliService->updatePolicyData($data,$id);
    
            return redirect()->route('poli_admin')->with('success', 'Sửa Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Sửa Thất Bại. Vui lòng thử lại sau.']);
        }
    }

    public function getAllPolicyForUser(){
        try{
            $policyList = $this->poliService->getAllPolicy();
            return view('frontend.chinhsach', compact('policyList'));
        }catch (\Exception $e){
            abort(404, 'No get data for news');
        }
    }
    public function getDetailPolicy($slug){
        try{
            $policy = $this->poliService->getDetailbySlug($slug);
            $relatedPolicy = $this->poliService->getRelatedPolicy($slug);
            // dd($relatedPolicy);die();
            return view('frontend.chitietchinhsach', compact('policy', 'relatedPolicy'));
        }catch (\Exception $e){
            abort(404, 'No get data for news');
        }
    }
}
