<?php

namespace App\Mail;

use App\Models\formularios\solicitudempleo;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Empleo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $idsolicitud;
    public function __construct($idsolicitud)
    {
        $this->idsolicitud = $idsolicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $solicitud = solicitudempleo::find($this->idsolicitud);
        return $this->view('mail.solicitudempleo',compact('solicitud'));
    }
}
