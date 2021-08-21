<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DefaultController extends Controller
{
    public function index()
    {
        Config::set('database.connections.mysql.database','news');
        Config::set('database.connections.mysql.username','root');
        return view('index');

    }

    public function login()
    {
        return view('admin.default.login');

    }

    public function authenticate(Request $request)
    {
        @$request->flash();
        //sadece bu türden gelen request isteklerini tutması için email ve password güvenlik adına
        $credentials = $request->only('email', 'password');
        //bu işlem ise oturum süresi bittiğin de eğer beni hatırla seçeneği aktif ise oturumdan düşmemesi için
        //auth attempt'in yanına ikinci parametre olarak gönderiyoruz true ise çıkış yapana kadar oturum da duruyor.
        $remember_me = $request->has('remember_me') ? true : false;
        //yukarıda ki aldığımız değişkenini Attempt edip içine gönderdiğimiz de login kontrolümüz gerçekleşliyor
        //ona göre giriş yapabilir veya şifre yanlış mesajı ekrana basabiliriz.
        if (Auth::attempt($credentials, $remember_me)) {
            return redirect()->intended(route('admin.dashboard'));
        }
        else
        {
            //error'u login kısımına buradan gönderiyoruz.
            return redirect(route('Admin.login'))->with('error','Giriş Yapılamadı!');
        }
    }
}
