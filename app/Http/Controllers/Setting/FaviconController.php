<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Services\SettingRepository;
use Illuminate\Http\Request;

class FaviconController extends Controller
{
    protected $settingService;

    public function __construct(SettingRepository $settingService)
    {
        $this->settingService = $settingService;
    }
    public function viewPageFavicon(){
        return view('admin.setting.qlifavicon');
    }

    public function updateFavicon(Request $request){
        $data = $request->all();
        try{
            $this->settingService->updateFavicon($data);
            return redirect()->route('favicon_admin')->with('success','Cập Nhật Favicon Thành Công!');
        }catch( \Exception $e){
            return redirect()->route('favicon_admin')->with('error','Có lỗi khi cập nhật');
        }
    }
}
