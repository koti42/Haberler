<?php

namespace app\Helpers\Helpers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;
use function App\Helpers\helper\getVar;

class Helper
{
    public static function getRoles()
    {
        //getVar fonksiyonu helper fonksiyonuna system.json'ın ismini gönderiyor çalışması için.
        //system olmayabilir adı ahmet mehmet veli de olabilir önemli olan dosyanın ismi
        //ahmet giderse helper'da sonuna .json eklenip sonusu ahmet.json olacaktır.
        $defaultSystemVars = getVar('system');
        //burası ise veri tabanından pluck ile name alanlarını çekiyor.
        $roles = Role::all()->pluck('name')->all();
        $permissions = Permission::all()->pluck('name')->all();


        //hata almamak için role ve permission değişkenlerine boş değer ataması yapıyoruz.
        $role = '';
        $permission = '';
        $users = '';
        foreach ($defaultSystemVars['default_role'] as $value) {
            //return $value['name'];
            //in_array metodu bunun için de varsa diye işlev görüyor
            //php in array komutuna bakabilirsin detaylar için.
            //ve de default olarak system.json dosyasına girdiğimiz yetkiler veri tabanın da ilk başta yüklü olmayacağı için
            //default olarak system.json dosyasına giriyoruz bu sayede yetki verilmemiş olma olasılığının önüne geçiyoruz
            //aynı zamanda bu komut veri tabanına tekrar aynı veriyi yazmamızı engelliyor kontrol ederek bu sayede hata almıyoruz.
            if (!in_array($value['name'], $roles)) {

                //normal şartlar da admin panel görme yeteneği default olarak 0 geliyor veri tabanı tablosunda veri olmasa bile
                //ama admin kullanıcısı eklendiğin de admin panele giriş yapabilmesi için veya editörün name kısmında gelen veri
                //user'a eşit değil ise admin paneli görme yetkisini 1 değil ise 0 yapıyoruz

                if ($value['name'] !== 'User') {
                    $is_see_admin = 1;
                } else if ($value['name'] == 'User') {
                    $is_see_admin = 0;
                }
                $role = Role::create([
                    'name' => $value['name'],
                    'description' => $value['description'],
                    'is_main' => 1,
                    'is_show_admin' => $is_see_admin,
                    'guard_name' => $value['guard_name'],
                    'slug' => Str::slug($value['name'])
                ]);

            }
        }
        foreach ($defaultSystemVars['default_permission'] as $value) {
            //in_array metodu bunun için de varsa diye işlev görüyor
            //php in array komutuna bakabilirsin detaylar için.
            //ve de default olarak system.json dosyasına girdiğimiz yetkiler veri tabanın da ilk başta yüklü olmayacağı için
            //default olarak system.json dosyasına giriyoruz bu sayede yetki verilmemiş olma olasılığının önüne geçiyoruz
            if (!in_array($value['name'], $permissions)) {
                $permission = Permission::create([
                    'name' => $value['name'],
                    'description' => $value['description'],
                    'is_main' => 1,
                    'guard_name' => $value['guard_name'],
                ]);

            }
        }


        $users = User::all()->pluck('email')->all();
        foreach ($defaultSystemVars['default_user'] as $value) {
            //in_array metodu bunun için de varsa diye işlev görüyor
            //php in array komutuna bakabilirsin detaylar için.
            //ve de default olarak system.json dosyasına girdiğimiz yetkiler veri tabanın da ilk başta yüklü olmayacağı için
            //default olarak system.json dosyasına giriyoruz bu sayede yetki verilmemiş olma olasılığının önüne geçiyoruz
            if (!in_array($value['email'], $users)) {
                $user = User::create([
                    'name' => $value['name'],
                    'email' => $value['email'],
                    'password' => bcrypt($value['password']),
                    'google_id'=>null,
                ]);

            }
        }


        //bu aşağıda ki kısım yetkilendirme ve role atama işlemlerini yapıyor
        //ilk eklenen veriler için

        $permissions = Permission::all()->pluck('name')->all();
        $permissions = Permission::all();
        $permissions2 = Permission::whereNotIn('name', ['artisan-permission'])->get();

        $admin_role = Role::whereName('admin')->first();
        $system_admin_role = Role::whereName('System-Admin')->first();

        $admin_user = User::whereEmail('medine@medine.com.tr')->first();
        $system_admin = User::whereEmail('mehmet@mehmetkucukcelebi.com.tr')->first();

        $editor_role = Role::whereName('Editor')->first();
        $user_role = Role::whereName('User')->first();
        $webUser = User::whereEmail('user@user.com')->first();
        $webEditor = User::whereEmail('editor@editor.com')->first();


        $webEditor->assignRole($editor_role);

        $admin_user->assignRole($admin_role);
        $system_admin->assignRole($system_admin_role);

        $webUser->assignRole($user_role);

        $admin_role->givePermissionTo($permissions2);
        $system_admin_role->givePermissionTo($permissions);


    }
}

