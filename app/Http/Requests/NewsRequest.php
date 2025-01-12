<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class NewsRequest extends FormRequest
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
                $id ? Rule::unique('news', 'slug')->ignore($id) : 'unique:news,slug',
            ],
            'news_name_vi' => 'required|string|max:255',
            'news_name_en' => 'required|string|max:255',
            'fileToUpload' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ];
    }
    
    // public function messages(){
    //     // dd($this->all());
    //     return[
    //         'news_name_vi.max' => 'Tên không được quá 255 kí tự',
    //     ];
    // }


}
