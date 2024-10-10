<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\TrueType;

class PaymentRequest extends FormRequest
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
            //
            'checked-payment' => 'required',
            'fullname' => 'max:60',
            'phone' => 'required|digits:10|starts_with:0',
            'address' => 'required',
        ];
    }

    // hàm xuất lỗi
    public function messages()
    {
        return [
            'checked-payment.required' => 'Vui lòng chọn phương thức thanh toán trước khi thanh toán.',
            'fullname.max' => 'Tên người nhận không quá 60 kí tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.digits' => 'Số điện thoại bắt buộc là 10 số.',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu từ số 0.',
            'address.required' => 'Địa chỉ người nhận không được để trống.'
        ];
    }
}
