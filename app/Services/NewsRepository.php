<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsTranslation;
use Illuminate\Support\Facades\DB;
use App\Services\FileStorageService;
use Illuminate\Support\Str;


class NewsRepository extends AbstractCrud
{
    protected $languageCode;
    protected $fileStorageService;

    public function __construct(News $model,FileStorageService $fileStorageService)
    {
        parent::__construct($model);
        // $this->languageCode = session()->get('locale', 'vi');
        $this->fileStorageService = $fileStorageService;
    }
    public function updateLanguageCode()
    {
        return $this->languageCode = session()->get('locale','vi');
    }

    public static function baseQuery()
    {
        return NewsTranslation::select(
                'news.id', 
                'news.slug', 
                'news.news_image',
                'news_translations.news_name', 
                'news_translations.news_desc', 
                'news.noi_bat',
                'news.created_at'
            )
            ->join('news', 'news.id', '=', 'news_translations.news_id');
    }
    public function getDetail($id)
    {
        $news = NewsTranslation::select(
            'news.id', 
            'news.slug', 
            'news.news_image',
            'news_translations.language_code',
            'news_translations.news_name', 
            'news_translations.news_desc',
        )
        ->join('news', 'news.id', '=', 'news_translations.news_id')
        ->where('news.id', $id)->get();
        if ($news->isEmpty()) {
            return abort(404); // Không tìm thấy sản phẩm
        }
        $translations = $news->groupBy('language_code');

        // Lọc bản dịch tiếng Việt và tiếng Anh
        $translations = [
            'vi' => $translations->get('vi')->first(),
            'en' => $translations->get('en')->first(),
        ];
        return $translations;
    }

    // Bạn có thể thêm các phương thức riêng cho tin tức tại đây
    public function getAllNews(){
        return self::baseQuery()
            ->where('news_translations.language_code', $this->updateLanguageCode())
            ->orderBy('news.created_at', 'desc')
            ->paginate(8);
    }
    public function getAllNewsbyKeyword($keyword)
    {
        return self::baseQuery()
            ->where('news_translations.language_code', $this->updateLanguageCode()) // Lọc theo ngôn ngữ
            ->where('news_translations.news_name', 'like', '%' . $keyword . '%') // Tìm kiếm theo tên
            ->orderBy('news.created_at', 'desc') // Sắp xếp theo thời gian tạo
            ->paginate(8); // Phân trang
    }


    public function delete($id){
        News::findOrFail($id)->delete();
        NewsTranslation::where('news_id', $id)->delete();
    }

    public function deleteSelectedIds($selectedIds){
        if (!empty($selectedIds)) {
            // Xóa các bài viết với các ID đã chọn
            News::whereIn('id', $selectedIds)->delete();
            NewsTranslation::whereIn('news_id', $selectedIds)->delete();
        }
    }

    public function createNewsData($data)
    {
        // Start transaction
        return DB::transaction(function () use ($data) {
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if(isset($data['fileToUpload']) && $data['fileToUpload'] != null){
                $uploadedFilePath = $this->fileStorageService->upload_file($data['fileToUpload'], 'news');
            }
            // dd($uploadedFilePath);die();
            // Create the News entry
            $news = News::create([
                'slug' => $data['slug'],
                'news_image' => isset($uploadedFilePath) ? $uploadedFilePath : '/storage/news/noimage.png',
                'noi_bat' => true,
            ]);
            // dd($news);die();
            // Create the NewsTranslation entry
            NewsTranslation::insert([
                [
                    'id' => Str::uuid()->toString(),
                    'news_id' => $news->id,
                    'language_code' => 'vi',
                    'news_name' => $data['news_name_vi'],
                    'news_desc' => htmlspecialchars($data['contentvi'], ENT_QUOTES, 'UTF-8'),
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'news_id' => $news->id,
                    'language_code' => 'en',
                    'news_name' => $data['news_name_en'],
                    'news_desc' => htmlspecialchars($data['contenten'], ENT_QUOTES, 'UTF-8'),
                ]
            ]);
        });
    }

    public function updateNewsData($data,$id){
        // Start transaction
        return DB::transaction(function () use ($data,$id) {
            $news = $this->getById($id);
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if(isset($data['fileToUpload']) && $data['fileToUpload'] != null){
                $uploadedFilePath = $this->fileStorageService->upload_file($data['fileToUpload'], 'news');
                //xóa ảnh
                $this->fileStorageService->remove_file($news->news_image);
            }
            // dd($uploadedFilePath);die();
            // Create the News entry
            $news->update([
                'slug' => $data['slug'],
                'news_image' => isset($uploadedFilePath) ? $uploadedFilePath : $news->news_image,
                'noi_bat' => true,
            ]);
            // dd($news);die();
            // dd($news);die();
            foreach (['vi', 'en'] as $lang) {
                // Cập nhật hoặc tạo bản dịch cho từng ngôn ngữ
                NewsTranslation::updateOrCreate(
                    ['news_id' => $news->id, 'language_code' => $lang],
                    [
                        'news_name' => $data["news_name_{$lang}"],
                        'news_desc' => htmlspecialchars($data["content{$lang}"], ENT_QUOTES, 'UTF-8'),
                    ]
                );
            }
        });
    }

    public function getDetailbySlug($slug)
    {
        $query = self::baseQuery()
        ->where('news_translations.language_code', $this->updateLanguageCode())
        ->where('news.slug', $slug);
        if(!$query->exists()){
            return abort(404); 
        }
        return $query->first();
    }

    public function getRelatedNews($slug){
        return self::baseQuery()
        ->where('slug', '!=', $slug)
        ->where('news_translations.language_code', $this->updateLanguageCode())
        ->limit(5)
        ->get();
    }
}