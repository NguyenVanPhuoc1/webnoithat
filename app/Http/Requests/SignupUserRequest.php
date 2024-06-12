<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // validate dữ liệu khi khách hàng đăng kí
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'new-password' => 'required|string|min:6',
            'current-password' => 'required|string|same:new-password',
        ];
    }

    // hàm xuất lỗi
    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống. Vui lòng nhập email khác.',
            'new-password.required' => 'Mật khẩu là bắt buộc.',
            'new-password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'new-password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'current-password.required' => 'Mật khẩu là bắt buộc.',
            'current-password.same' => 'Mật khẩu nhập lại không khớp!',
        ];
    }
}
