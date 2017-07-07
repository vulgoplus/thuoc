<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg',
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
            'image.required'       => 'Vui lòng chọn ảnh hiển thị!',
            'image.image'          => 'Vui lòng chọn ảnh!',
            'image.mimes'          => 'Ảnh bạn tải lên không đúng định dạng!',
        ];
    }
}
