<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class DefaultController extends Controller
{
    public function index()
    {


        return view('index');

    }

    public function login()
    {
        return view('admin.default.login');

    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleLogout($id)
    {
        $googleMd = User::where('id', $id)->first();
        $googleMd->google_id = null;
        $googleMd->save();
        return redirect()->to('admin')->with('success', 'Google Bağlantısı  Başarıyla Kesildi!');
    }

    public function handleProviderCallback()
    {
        // sadece @ den sonrası şu olan kullanıcıları kabul et google girişi ile
//        if (explode("@", $user->email)[1] !== 'mehmetkucukcelebi.com.tr') {
//            return redirect()->to('/');
//        }

        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            // kullanıcı var mı yok mu kontrolü
            if ($finduser) {
                // giriş yap
                auth()->login($finduser, true);
                return redirect('admin');
            } else if (Auth::check()) {
                if (!$finduser) {
                    $rols = auth()->user();
                    $googleLogin = User::findOrFail($rols->id);
                    $googleLogin->google_id = $user->id;
                    $googleLogin->save();
                    return redirect()->to('admin')->with('success', 'Google İle Hesap Bağlama Başarıyla Tamamlandı!');
                } else
                    return redirect()->to('admin')->with('error', 'Bu Google Hesabı Daha Önce Başka Bir Hesap İle Eşleştirildi!');

            } else {
                return redirect('/')->with('error', 'Daha Önce Bu Google Hesabı ile Bağlantı Yapılmamış!');
            }
        } catch (Throwable $e) {
            return redirect('/')->with('error', 'Bilinmeyen Bir Hata Gerçekleşti!');
        }
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
        } else {
            //error'u login kısımına buradan gönderiyoruz.
            return redirect(route('Admin.login'))->with('error', 'Giriş Yapılamadı!');
        }
    }
}
