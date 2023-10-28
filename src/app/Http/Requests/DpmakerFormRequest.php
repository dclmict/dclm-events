<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DpmakerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string',
            'district' => 'required|string',
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            '*.required'  => 'The :attribute field is required',
            'file.mimes' => 'Valid image types are jpg, jpeg, png, gif, bmp.',
            'file.max' => 'The image size should not exceed 2MB.',
        ];
    }
}
