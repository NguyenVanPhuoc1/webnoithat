<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Services\FileStorageService;
use Illuminate\Support\Str; 

class SettingRepository extends AbstractCrud
{
    protected $fileStorageService;
    public function __construct(Setting $model,FileStorageService $fileStorageService)
    {
        parent::__construct($model);
        $this->fileStorageService = $fileStorageService;
    }

    public function updateFavicon($data){
        $favicon = Setting::where('key','favicon')->first();
        return DB::transaction(function () use ($favicon,$data) {
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if(isset($data['new_favicon'])){
                if($data['new_favicon'] instanceof \Illuminate\Http\UploadedFile){
                    //thêm ảnh mới
                    $uploadedFilePath = $this->fileStorageService->upload_file($data['new_favicon'], 'setting');
                    //xóa ảnh cũ
                    $this->fileStorageService->remove_file($favicon->value);
                }
            }

            $favicon->value = $uploadedFilePath ?? $favicon->value;
            $favicon->save();

        });
    }

    public function updateLogo($data){
        $logo = Setting::where('key','logo')->first();
        return DB::transaction(function () use ($logo,$data) {
            //tạo đưuòng dẫn ảnh và thêm vào folder
            if(isset($data['new_logo'])){
                if($data['new_logo'] instanceof \Illuminate\Http\UploadedFile){
                    //thêm ảnh mới
                    $uploadedFilePath = $this->fileStorageService->upload_file($data['new_logo'], 'setting');
                    //xóa ảnh cũ
                    $this->fileStorageService->remove_file($logo->value);
                }
            }

            $logo->value = $uploadedFilePath ?? $logo->value;
            $logo->save();

        });
    }
}