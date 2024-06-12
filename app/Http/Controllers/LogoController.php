<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    public function index()
    {
        // Lấy dòng dữ liệu mới nhất từ bảng logos
        $newestLogo = Logo::latest('created_at')->first();

        // Kiểm tra nếu có dòng dữ liệu mới nhất
        if ($newestLogo) {
            // Lấy ra file_name từ dòng dữ liệu mới nhất
            $logo_name = $newestLogo->file_name;
            return view('admin.qlilogo', compact('logo_name'));
            // Sử dụng $logoName để truyền đi
        } else {
            // Nếu không có dòng dữ liệu nào trong bảng logos
            return view('admin.qlilogo');
        }
    }

    public function updateLogo(Request $request)
    {
        // Kiểm tra xem request có chứa file mới không
        if ($request->hasFile('new_logo')) {
            $file = $request->file('new_logo');

            // Lưu file mới vào thư mục và cập nhật tên file trong database
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/public/image/'), $fileName);

            // Lấy tên file logo cũ
            $logo = Logo::orderBy('created_at', 'desc')->first();
            $oldFileName = $logo->file_name;
            // Cập nhật tên file mới vào cơ sở dữ liệu
            $logo->file_name = $fileName;
            $logo->save();

            // Xóa file ảnh logo cũ
            $oldFilePath = public_path('front/public/image/') . $oldFileName;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            return redirect('/admin/logo')->with('success', 'Cập nhật logo thành công');
        }
        return redirect('/admin/logo');
    }
}
