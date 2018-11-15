<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordRecovery extends Mailable
{
    use Queueable, SerializesModels;
    public $Token, $Email, $Text_Soporte;


    public function __construct( $Email, $Token)     {
        $this->Token        = $Token;
        $this->Email        = $Email;
        $this->Text_Soporte = trans('_app.TEXT_SOPORTE');
    }

    public function build()    {

        return $this->view('mails.password-revovery')
              ->subject ('Recuperación de Contraseña');
    }

}
