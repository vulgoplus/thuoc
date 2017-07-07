<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg',
            'price'       => 'required|numeric|min:0',
            'sale'        => 'numeric|min:0|nullable'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(){
        return [
            'title.required'       => 'Bạn phải nhập tiêu đề!',
            'image.image'          => 'Vui lòng chọn ảnh!',
            'image.mimes'          => 'Ảnh bạn tải lên không đúng định dạng!',
            'price.required'       => 'Bạn phải nhập giá!',
            'price.numeric'        => 'Vui lòng nhập số!',
            'price.min'            => 'Giá phải là số dương!',
            'sale.numeric'         => 'Vui lòng nhập số!',
            'sale.min'             => 'Vui lòng nhập số dương!'
        ];
    }
}
