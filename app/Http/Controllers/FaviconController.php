<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Favicon;

class FaviconController extends Controller
{
    public function index()
    {
        // Lấy dòng dữ liệu mới nhất từ bảng favicon
        $newestFavicon = Favicon::latest('created_at')->first();

        // Kiểm tra nếu có dòng dữ liệu mới nhất
        if ($newestFavicon) {
            // Lấy ra file_name từ dòng dữ liệu mới nhất
            $favicon_name = $newestFavicon->file_name;
            return view('admin.qlifavicon', compact('favicon_name'));
            // Sử dụng $faviconName để truyền đi
        } else {
            // Nếu không có dòng dữ liệu nào trong bảng favicons
            return view('admin.qlifavicon');
        }
    }

    public function updatefavicon(Request $request)
    {
        // Kiểm tra xem request có chứa file mới không
        if ($request->hasFile('new_favicon')) {
            $file = $request->file('new_favicon');

            // Lưu file mới vào thư mục và cập nhật tên file trong database
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/public/image/'), $fileName);

            // Lấy tên file favicon cũ
            $favicon = Favicon::orderBy('created_at', 'desc')->first();
            $oldFileName = $favicon->file_name;
            // Cập nhật tên file mới vào cơ sở dữ liệu
            $favicon->file_name = $fileName;
            $favicon->save();

            // Xóa file ảnh favicon cũ
            $oldFilePath = public_path('front/public/image/') . $oldFileName;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            return redirect('/admin/favicon')->with('success', 'Cập nhật favicon thành công');
        }
        return redirect('/admin/favicon');
    }
}
