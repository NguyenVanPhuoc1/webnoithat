<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;

class CommentController extends Controller
{
    public function show($productId)
    {
        $productComments = ProductComment::where('product_id', $productId)->get();

        // Trả về view và truyền danh sách bình luận
        return view('product_detail', ['productComments' => $productComments]);
    }

    public function store(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingComment = ProductComment::where('email', $validatedData['email'])
            ->where('pro_id', $productId)
            ->first();

        if ($existingComment) {
            return redirect()->back()->with('fail', 'Email này đã được sử dụng để bình luận !');
        }

        // Nếu email chưa tồn tại, thêm bình luận mới
        $comment = new ProductComment();
        $comment->name = $validatedData['name'];
        $comment->email = $validatedData['email'];
        $comment->content = $validatedData['content'];
        $comment->pro_id = $productId;
        $comment->save();

        return redirect()->back();
    }
}
