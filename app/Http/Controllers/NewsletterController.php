<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Services\NewsletterRepository;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterRepository $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    //get all
    public function viewAdminNhanTin(){
        try {
            $cusList = $this->newsletterService->baseQuery();
            return view('admin.qlinhantin', compact('cusList'));
        }
        catch( \Exception $e){
            return abort(404);
        }
    }

    public function deleteNewsletterId($id){
        try{
            $this->newsletterService->delete($id);
            return redirect()->route('newsletter_admin')->with('success','Xóa Thành công!');
        } catch (\Exception $e) {
    
            return redirect()->route('newsletter_admin')->with('error','Xóa Không Thành công!');
        }
    }

    public function deleteNewsletterSelectedIds(Request $request){
        $selectedIds = $request->input('selectedIds', []);
        try{
            $this->newsletterService->deleteSelectedIds($selectedIds);
            return  response()->json(['success','Xóa Thành công!'],200);
        } catch (\Exception $e) {
    
            return response()->json( ['error','Xóa Không Thành công!'],400);
        }
    }
    //send mail
    public function sendMailCustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'title_email' => 'required|max:500',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        try{
            $data= $request->all();
            $this->newsletterService->sendMail($data);
            return  response()->json(['success','Gửi Thành công!'],200);
        }catch(\Exception $e){
            return response()->json( ['error','Gửi Không Thành công!'],500);
        }
    }

    //đăng kí nhận tin
    public function addCustomer(CustomerRequest $request){
        $data = $request->all();
        // dd($data);die();
        try {
            $this->newsletterService->addCustomer($data);
    
            return redirect()->back()->with('success', 'Đăng kí nhận tin thành công.');
        } catch (\Exception $e) {
            // Nếu có lỗi, chuyển hướng trở lại với thông báo lỗi
            return redirect()->back()->with(['error' => 'Đăng kí nhận tin thất bại']);
        }
    }
}
