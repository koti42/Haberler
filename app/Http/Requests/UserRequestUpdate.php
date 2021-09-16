<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
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
            'name'=>'required|max:90|min:2|string',
            'email'=>'required|max:200|min:10',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Name Alanı Gereklidir',
            'name.max'=>'İsim Alanı Maksimum 60 karakter olabilir',
            'name.min'=>'İsim Alanı Minimum 2 karakterden oluşmalıdır',
            'name.string'=>'Name Alanı String Olmalıdır',
            'email.min'=>'Mail Minimum 10 Karakterden Oluşmalıdır',
            'email.max'=>'Mail Maksimum 60 Karakterden Oluşmalıdır',
        ];
    }
}
