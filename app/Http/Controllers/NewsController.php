<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\Services\NewsRepository;
use App\Models\News;
use App\Models\NewsTranslation;

class NewsController extends Controller
{
    //dependency injection
    protected $newsService;

    public function __construct(NewsRepository $newsService)
    {
        $this->newsService = $newsService;
    }
    

    public static function getLoadedNews($languageCode){
        return NewsRepository::baseQuery()
            ->where('news_translations.language_code', $languageCode)
            ->orderBy('news.created_at', 'desc')->where('noi_bat', true)
            ->take(5)
            ->get();
    }
    public function viewAdminTintuc(Request $request){
        try {
            // Trả về view với danh sách chính sách
            $url = $request->fullUrl();
            
            if (str_contains($url, 'keyword')) {
                // Kiểm tra và validate dữ liệu đầu vào
                $request->validate([
                    'keyword' => 'required|max:100',
                ]);
                
                $keyword = $request->input('keyword');
                // Lấy danh sách các chính sách từ từ khóa
                $newsList = $this->newsService->getAllNewsbyKeyword($keyword);
            } else {
                // Lấy tất cả chính sách nếu không có từ khóa
                $newsList = $this->newsService->getAllNews();
            }
            // dd($newsList);die();
            return view('admin.qlitintuc', compact('newsList'));
        } catch (\Exception $e) {
    
            // Trả về lỗi 404 nếu có lỗi xảy ra
            abort(404, 'No get data for news');
        }
    }

    public function deleteNewsId($id){
        try{
            $this->newsService->delete($id);
            return redirect()->route('news_admin')->with('success','Xóa Thành công!');
        } catch (\Exception $e) {
    
            return redirect()->route('news_admin')->with('error','Xóa Không Thành công!');
        }
    }

    public function deleteNewsSelectedIds(Request $request){
        try{
            $selectedIds = $request->input('selectedIds', []);
            $this->newsService->deleteSelectedIds($selectedIds);
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
            $updatedCount = $this->newsService->getById($id)->update(['noi_bat' => $noiBatValue]);

            // Kiểm tra nếu không có bản ghi nào được cập nhật
            if ($updatedCount === 0) {
                return response()->json(['error' => 'Không tìm thấy bài viết nào với id này.'], 404);
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
    public function viewPageaddNews(){
        return view('admin.news.create');
    }
    public function addNews(NewsRequest $request){
        // Thu thập dữ liệu từ request
        $data = $request->all();
        try {
            $this->newsService->createNewsData($data);
    
            return redirect()->route('news_admin')->with('success', 'Thêm Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Thêm Thất Bại. Vui lòng thử lại sau.']);
        }
    }
    // view page update 
    public function viewPageupdateNews($id){
        $news = $this->newsService->getDetail($id);
        // dd($news);
        return view('admin.news.update',compact('news'));
    }

    public function updateNews(NewsRequest $request,$id){
        $data = $request->all();
        // dd($data);die();
        try {
            $this->newsService->updateNewsData($data,$id);
    
            return redirect()->route('news_admin')->with('success', 'Sửa Thành Công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Sửa Thất Bại. Vui lòng thử lại sau.']);
        }
    }


    //hiển thị trang tin tức người dùng
    public function getAllNewsForUser(){
        try{
            $newsList = $this->newsService->getAllNews();
            return view('frontend.tintuc', compact('newsList'));
        }catch (\Exception $e){
            abort(404, 'No get data for news');
        }
    }

    public function getDetailNews($slug){
        try{
            $news = $this->newsService->getDetailbySlug($slug);
            $relatedNews = $this->newsService->getRelatedNews($slug);
            // dd($relatedNews);die();
            return view('frontend.chitiettintuc', compact('news', 'relatedNews'));
        }catch (\Exception $e){
            abort(404, 'No get data for news');
        }
    }
}
