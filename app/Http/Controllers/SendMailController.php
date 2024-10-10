<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleMail;
use App\Models\Customers;
use App\Events\AdminNotification; // Đảm bảo bạn đã import sự kiện này
use App\Jobs\SendEmailJob;

class SendMailController extends Controller
{
    //
    public function viewPageQliNhanTin(){
        $cusList = Customers::orderBy('created_at', 'desc')->paginate(5);
        // dd($cusList);die();
        return view('admin.qlinhantin',compact('cusList'));
    }
    // hàm gửi mail
    public function sendEmail($selectedData,$title, $content) {
        // lấy id thông tin khách cần gửi
        foreach ($selectedData['selectedIds'] as $cusId) {
            $user = Customers::find($cusId);
            // dd($user->email);die();
            if ($user) {
                $details = [
                    'email' => $user->email,
                    'title' => $title,
                    'content' => $content,
                ];
                // Dispatch job gửi email vào hàng đợi
                SendEmailJob::dispatch($details);

            }
        }
    }

    // hàm lấy dữ liệu
    public function selected_data(Request $request){
        $type = $request->input('delete_type', 'single');
        $selectedIds = $request->input('customer_ids', []);
        $type_click = $request->input('type_click');
        // dd($type_click);die();
        return [
            'type' => $type,
            'selectedIds' => $selectedIds,
            'type_click' => $type_click,
        ];
    }

    //hàm tổng customer dùng cho xóa hoặc sửa   
    public function totalCustomer(Request $request){
        $selectedData = $this->selected_data(request());
        $type = $selectedData['type'];
        $selectedIds = $selectedData['selectedIds'];

        // dd($selectedData);die();
        if($selectedData['type_click'] == 'send'){
            // thực hiện gửi
            $request->validate([
                'title_email' => 'required|max:500',
            ]);
            $title_email = $request->input('title_email');
            $content_email = $request->input('content_email');
            // dd($title_email);
            $this->sendEmail($selectedData, $title_email, $content_email);
        }else{
            //thực hiện xóa
            $this->deleteCustomer($type, $selectedIds);
        }
        

        return redirect('/admin/quanlinhantin')->withSuccess('Xóa Thành công!');
    }

    //hàm xóa customer
    public function deleteCustomer($type,$selectedIds){
        if($type == 'single'){
            // Xóa một bài viết
            $id = $selectedIds[0];
            // dd($id);die();
            $cus = Customers::findOrFail($id);
            $cus->delete();
        } elseif ($type == 'multiple') {
            // Xóa nhiều bài viết (nếu có các selected_ids được chọn)       

            if (!empty($selectedIds)) {
                // Xóa các bài viết với các ID đã chọn
                Customers::whereIn('id', $selectedIds)->delete();
            }
        } elseif ($type == 'all') {
            // Xóa tất cả bài viết
            Customers::truncate(); 
        } else {
            abort(404);
        }
    }

    // xóa theo id
    public function deleteCustomerbyId($id){
        $cus = Customers::findOrFail($id);
        $cus->delete();
        return redirect('/admin/quanlinhantin')->withSuccess('Xóa Thành công!');
    }

    //hàm thêm tin tức trong trang chủ và trang liên hệ
    //tạo data dữ liệu
    public function create(array $data)
    {   
        return Customers::create([
            'cus_name' => $data['fullname'],
            'email' => $data['email'],
            'cus_phone' => $data['phone'],
            'cus_content' => $data['content'],
        ]);
    }     
    //thêm đăng kí nhạn tin
    public function AddCustomer(Request $request)
    { 
        $request->validate([
            'fullname' => 'required|max:255',
            'phone' => 'required|digits:10|starts_with:0',
            'email' => 'required|email|unique:customer| max:255',
            'content' => 'required|max:1000'
        ]);
        $data = $request->all();
        // dd($data);die();
        // dd(new AdminNotification('New user registered: ' . $data['fullname']));die();
        $cus = $this->create($data);

        // Gửi sự kiện đến Laravel Echo
        event(new AdminNotification('New user registered: ' . $data['fullname']));

        if (str_contains($request->header('referer'), 'lien-he')) {
            return redirect('/lien-he')->withSuccess('Đăng kí Thành công!');
        } else {
            return redirect('/')->withSuccess('Đăng kí Thành công!');
        }
    }
}
