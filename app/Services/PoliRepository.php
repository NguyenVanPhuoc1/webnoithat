<?php

namespace App\Services;

use App\Models\Policy;
use App\Models\PolicyTranslation;
use App\Services\FileStorageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PoliRepository extends AbstractCrud
{
    protected $languageCode;
    protected $fileStorageService;

    public function __construct(Policy $model,FileStorageService $fileStorageService)
    {
        parent::__construct($model);
        $this->languageCode = session()->get('locale', 'vi');
        $this->fileStorageService = $fileStorageService;
    }
    public function updateLanguageCode()
    {
        return $this->languageCode = session()->get('locale','vi');
    }
    // Bạn có thể thêm các phương thức riêng cho tin tức tại đây
    public static function baseQuery(){
        return PolicyTranslation::select(
            'policy.id', 
            'policy.slug', 
            'policy.poli_image',
            'policy_translations.poli_name', 
            'policy_translations.poli_desc', 
            'policy.noi_bat' ,
            'policy.created_at' 
        )
        ->join('policy', 'policy.id', '=', 'policy_translations.policy_id');
    }
    public function getDetail($id)
    {
        $policy = PolicyTranslation::select(
            'policy.id', 
            'policy.slug', 
            'policy.poli_image',
            'policy_translations.language_code',
            'policy_translations.poli_name', 
            'policy_translations.poli_desc',
        )
        ->join('policy', 'policy.id', '=', 'policy_translations.policy_id')
        ->where('policy.id', $id)->get();
        if ($policy->isEmpty()) {
            return abort(404); // Không tìm thấy sản phẩm
        }
        $translations = $policy->groupBy('language_code');

        // Lọc bản dịch tiếng Việt và tiếng Anh
        $translations = [
            'vi' => $translations->get('vi')->first(),
            'en' => $translations->get('en')->first(),
        ];
        return $translations;
    }
    public function getAllPolicy(){
        return self::baseQuery()
            ->where('policy_translations.language_code', $this->updateLanguageCode())
            ->orderBy('policy.created_at', 'desc')
            ->paginate(8);
    }
    public function getAllPolibyKeyword($keyword)
    {
        return self::baseQuery()
            ->where('policy_translations.language_code', $this->updateLanguageCode())
            ->where('policy_translations.poli_name', 'like', '%' . $keyword . '%') // Tìm kiếm theo tên
            ->orderBy('policy.created_at', 'desc') // Sắp xếp theo thời gian tạo
            ->paginate(8); // Phân trang
    }


    public function delete($id){
        $this->delete($id);
        PolicyTranslation::where('policy_id', $id)->delete();
    }

    public function deleteSelectedIds($selectedIds){
        if (!empty($selectedIds)) {
            // Xóa các bài viết với các ID đã chọn
            Policy::whereIn('id', $selectedIds)->delete();
            PolicyTranslation::whereIn('policy_id', $selectedIds)->delete();
        }
    }
    public function createPolicyData($data)
    {
        // Start transaction
        return DB::transaction(function () use ($data) {
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if($data['fileToUpload'] instanceof \Illuminate\Http\UploadedFile){
                $uploadedFilePath = $this->fileStorageService->upload_file($data['fileToUpload'], 'policy');
            }
            // dd($uploadedFilePath);die();
            // Create the Policy entry
            $policy = Policy::create([
                'slug' => $data['slug'],
                'poli_image' => isset($uploadedFilePath) ? $uploadedFilePath : '/storage/policy/noimage.png',
                'noi_bat' => true,
            ]);
            // dd($policy);die();
            // Create the PolicyTranslation entry
            PolicyTranslation::insert([
                [
                    'id' => Str::uuid()->toString(),
                    'policy_id' => $policy->id,
                    'language_code' => 'vi',
                    'poli_name' => $data['poli_name_vi'],
                    'poli_desc' => htmlspecialchars($data['contentvi'], ENT_QUOTES, 'UTF-8'),
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'policy_id' => $policy->id,
                    'language_code' => 'en',
                    'poli_name' => $data['poli_name_en'],
                    'poli_desc' => htmlspecialchars($data['contenten'], ENT_QUOTES, 'UTF-8'),
                ]
            ]);
        });
    }

    public function updatePolicyData($data,$id){
        // Start transaction
        return DB::transaction(function () use ($data,$id) {
            $policy = $this->getById($id);
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if(isset($data['fileToUpload']) && $data['fileToUpload'] != null){
                $uploadedFilePath = $this->fileStorageService->upload_file($data['fileToUpload'], 'policy');
                //xóa ảnh
                $this->fileStorageService->remove_file($policy->poli_image);
            }
            // dd($uploadedFilePath);die();
            // Create the Policy entry
            $policy->update([
                'slug' => $data['slug'],
                'poli_image' => isset($uploadedFilePath) ? $uploadedFilePath : $policy->poli_image,
                'noi_bat' => true,
            ]);
            // dd($policy);die();
            foreach (['vi', 'en'] as $lang) {
                // Cập nhật hoặc tạo bản dịch cho từng ngôn ngữ
                PolicyTranslation::updateOrCreate(
                    ['policy_id' => $policy->id, 'language_code' => $lang],
                    [
                        'poli_name' => $data["poli_name_{$lang}"],
                        'poli_desc' => htmlspecialchars($data["content{$lang}"], ENT_QUOTES, 'UTF-8'),
                    ]
                );
            }
        });
    }

    public function getDetailbySlug($slug)
    {
        $query = self::baseQuery()
        ->where('policy_translations.language_code', $this->updateLanguageCode())
        ->where('policy.slug', $slug);
        if(!$query->exists()){
            return abort(404); 
        }
        return $query->first();
    }

    public function getRelatedPolicy($slug){
        return self::baseQuery()
        ->where('slug', '!=', $slug)
        ->where('policy_translations.language_code', $this->updateLanguageCode())
        ->limit(5)
        ->get();
    }

}