<?php

namespace App\Mail\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactoryUsersMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $User;
    public function __construct(User $VerifiedMail)
    {
       $this->User=$VerifiedMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $User=$this->User;
        return $this->from('support@mehmetkucukcelebi.com.tr')->view('admin.default.mail_two_factory_authenticate',compact('User'));
    }
}
