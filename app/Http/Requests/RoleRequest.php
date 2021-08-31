<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name'=>'required|max:50|min:5|unique:roles|string',

        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Role Alanı Gereklidir',
            'name.max'=>'Role Alanı Maksimum 50 karakter olabilir',
            'name.min'=>'Role Alanı Minimum 5 karakterden oluşmalıdır',
            'name.string'=>'Name Alanı String Olmalıdır',
            'name.unique'=>'Rol Daha Önce Eklenmiştir',

        ];
    }
}
