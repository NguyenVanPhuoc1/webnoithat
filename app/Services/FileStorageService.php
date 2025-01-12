<?php 
namespace App\Services;

use App\Contracts\FileStorageInterface;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class FileStorageService implements FileStorageInterface    
{
    public function upload_file($file, $directory)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::uuid() . '.' . $extension ;
        // $image = ImageManager::imagick()->read($fileName);
        // dd($image);die();
        // $image->resize(900, 900);
        Storage::disk('public')->putFileAs($directory, $file, $fileName);

        return "/storage/$directory/$fileName";
    }

    public function remove_file($filePath)
    {    
        $filePath = str_replace(asset('/storage'), '', $filePath);
        // dd($filePath);die();
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }

        return false;
    }
}
