<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class Restablecer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $idusuario;
    public function __construct($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = User::find($this->idusuario);
        $hora = date('d/m/Y h:i:s');
        $toquen = substr(Crypt::encryptString($hora),0,20);
        $usuario->remember_token = $toquen;
        $usuario->save();
        return $this->view('mail.restablecer',compact('usuario'));
    }
}
