<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Services\SettingRepository;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    protected $settingService;

    public function __construct(SettingRepository $settingService)
    {
        $this->settingService = $settingService;
    }
    public function viewPageLogo(){
        return view('admin.setting.qlilogo');
    }

    public function updateLogo(Request $request){
        $data = $request->all();
        try{
            $this->settingService->updateLogo($data);
            return redirect()->route('logo_admin')->with('success','Cập Nhật Logo Thành Công!');
        }catch( \Exception $e){
            return redirect()->route('logo_admin')->with('error','Có lỗi khi cập nhật');
        }
    }
}
