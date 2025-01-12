<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        // dd($this->all());
        return [
            'fullname' => 'max:60',
            'phone' => 'required|digits:10|starts_with:0',
            'address' => 'required',
            'checked-payment' => 'required|in:tt-truc-tuyen,cod,tt-qr-payos',
            'bank' => 'in:NCB,VIETCOMBANK,MBBANK,VIB,ACB|required_if:checked-payment,tt-truc-tuyen',
        ];
    }

    // hàm xuất lỗi
    public function messages()
    {
        return [
            'fullname.max' => 'Tên người nhận không quá 60 kí tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.digits' => 'Số điện thoại bắt buộc là 10 số.',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu từ số 0.',
            'address.required' => 'Địa chỉ người nhận không được để trống.',
            'bank.required' => 'Vui lòng chọn ngân hàng thanh toán.',
            'bank.in' => 'Ngân hàng không hợp lệ.',
            'checked-payment.required' => 'Vui lòng chọn phương thức thanh toán.',
            'checked-payment.in' => 'Phương thức thanh toán không hợp lệ.',
        ];
    }
}
