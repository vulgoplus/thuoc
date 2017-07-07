<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'address' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(){
        return [
            'name.required'    => 'Vui lòng nhập tên của bạn!',
            'email.required'   => 'Vui lòng nhập email!',
            'email.email'      => 'Email không đúng định dạng!',
            'phone.required'   => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ'    
        ];
    }
}
