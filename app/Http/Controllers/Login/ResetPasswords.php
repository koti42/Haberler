<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Mail\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswords extends Controller
{
    public function resetPassword()
    {
        return view('admin.default.password_reset');
    }

    public function reset_Password(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        $user = User::whereEmail($email)->where('reset_password_token', $token)
            ->where('reset_password_expired', '>', now())
            ->update(['password' => bcrypt($password),
            ]);
        if ($user) {
            return redirect(route('Admin.login'))->with('success', 'Şifreniz Başarı İle Değiştirilmiştir!');
        } else
            return redirect(route('Admin.login'))->with('error', 'Yanlış Mail Girişi Yapıldı!');

    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $user = User::whereEmail($email)->first();
        if ($user) {
            $user->reset_password_token = Str::random(40);
            $user->reset_password_expired = now()->addMinutes('180');
            $user->save();

            $mail = new ResetPasswordMail($user);
            Mail::to($user->email)->send($mail);
            return redirect(route('reset.password'))->with('success', 'Mail Başarı ile Gönderilmiştir!');
        } else {
            return redirect(route('reset.password'))->with('success', 'Mail Başarı ile Gönderilmiştir!');
        }
    }

    public function resetPasswordShow(Request $request)
    {
        $user = $request->token;
        $veri = User::where('reset_password_token', $user)->first();

        if ($veri && $veri->reset_password_expired > date(now())) {
            return view('admin.default.reset_password', compact('veri'));
        } else
            return redirect(route('reset.password'))->with('error', 'Zamanı Dolmuş Bir Sıfırlama Linkine Tıkladınız veya Yeni Bir Sıfırlama Maili Talep Ettiniz!');


    }
}
