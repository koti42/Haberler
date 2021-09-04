<?php

namespace App\Listeners;

use App\Events\UsersAdded;
use App\Mail\Mail\ResetPasswordMail;
use App\Mail\Mail\VerifiedUsersMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendUsersMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UsersAdded $veri
     * @return void
     */
    public function handle(UsersAdded $veri)
    {
        $maill = $veri->User->email;
        $gonder = User::whereEmail($maill)->first();
        if ($gonder) {
            $gonder->email_verified_control = Str::random(60) . '-active';
            $gonder->save();

            $mail = new VerifiedUsersMail($gonder);
            Mail::to($gonder->email)->send($mail);
            return redirect(route('reset.password'))->with('success', 'Mail Başarı ile Gönderilmiştir!');
        } else {
            return redirect(route('reset.password'))->with('success', 'Mail Başarı ile Gönderilmiştir!');
        }

    }
}
