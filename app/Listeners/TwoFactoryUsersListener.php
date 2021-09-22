<?php

namespace App\Listeners;

use App\Events\TwoFactoryUsers;
use App\Mail\Mail\TwoFactoryUsersMail;
use App\Mail\Mail\VerifiedUsersMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TwoFactoryUsersListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     *
     * @param  TwoFactoryUsers $veri
     * @return void
     */
    public function handle(TwoFactoryUsers $veri)
    {
        $maill = $veri->User->email;
        $gonder = User::whereEmail($maill)->first();
        if ($gonder) {
            $gonder->two_factory_verified_success;
            $mail = new TwoFactoryUsersMail($gonder);
            Mail::to($gonder->email)->send($mail);
        }
    }
}
