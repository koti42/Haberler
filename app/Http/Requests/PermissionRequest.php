<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name'=>'required|max:90|min:5|string|unique:permissions',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Yetki İsmini Belirtmeniz Gerekmektedir',
            'name.max'=>'Yetki İsmini Maksimum 90 karakter Olabilmektedir',
            'name.min'=>'Yetki İsmi Minumum 5 Karakter Olabilmektedir',
            'name.unique'=>'Aynı Yetkiden 1 den Fazla Ekleme Yapılamaz!',
            'name.string'=>'Yetki Alanı String Olmak Zorundadır!'
        ];
    }
}
