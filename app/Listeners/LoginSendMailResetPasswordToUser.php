<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\LoginSendMailResetPassword;
use App\Mail\PasswordRecovery;
class LoginSendMailResetPasswordToUser
{

    public function handle(LoginSendMailResetPassword $event)  {
        Mail::to( $event->email )->send( new PasswordRecovery ( $event->email, $event->token) );
    }

}
