<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'slug' => [
                'required',
                'string',
                'max:255',
                $id ? Rule::unique('products', 'slug')->ignore($id) : 'unique:products,slug',
            ],
            'product_name_vi' => 'required|string|max:255',
            'product_name_en' => 'required|string|max:255',
            'cate_id' => 'required',
            'product_price' => 'required|integer|min:0',
            'discount_percent' => 'required|integer|min:0|max:50'
        ];
    }
}
