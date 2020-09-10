<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadastroRespTecPorEmail extends Mailable
{
    use Queueable, SerializesModels;
    // public $nomeUsuario;
    public $nomeEmpresa;
    public $passwordTemporario;
    // public $tipo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $passwordTemporario, $nomeEmpresa)
    {
      // $this->nomeUsuario    = $nomeUsuario;
      $this->nomeEmpresa           = $nomeEmpresa;
      $this->passwordTemporario    = $passwordTemporario;
    //   $this->tipo                  = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.conviteRespTecnico');
    }
}
