<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email'=>'required|max:200|min:10|unique:users',
            'password'=>'required|min:6|max:60',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Name Alanı Gereklidir',
            'name.max'=>'Name Alanı Maksimum 90 karakter olabilir',
            'name.min'=>'Name Alanı Minimum 2 karakterden oluşmalıdır',
            'name.string'=>'Name Alanı String Olmalıdır',
            'email.unique'=>'Mail Adresi Daha Önce Kullanılmıştır',
            'email.min'=>'Mail Minimum 10 Karakterden Oluşmalıdır',
            'email.max'=>'Mail Maksimum 60 Karakterden Oluşmalıdır',
            'password.max'=>'Şifreniz Maksimum 60 Karakterden Oluşmalıdır',
            'password.min'=>'Şifreniz Minimum 6 Karakterden Oluşmalıdır',
        ];
    }
}
