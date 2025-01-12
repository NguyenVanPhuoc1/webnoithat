<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PolicyRequest extends FormRequest
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
                $id ? Rule::unique('policy', 'slug')->ignore($id) : 'unique:policy,slug',
            ],
            'poli_name_vi' => 'required|string|max:255',
            'poli_name_en' => 'required|string|max:255',
            'fileToUpload' => 'nullable|mimes:png,jpg,jpeg|file|max:2048',
        ];
    }
}
