<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadastroUsuarioPorEmail extends Mailable
{
    use Queueable, SerializesModels;
    // public $nomeUsuario;
    // public $nomeEmpresa;
    public $passwordTemporario;
    public $tipo;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $passwordTemporario, $tipo, $email)
    {
      // $this->nomeUsuario    = $nomeUsuario;
      //$this->nomeEmpresa  = $nomeEmpresa;
      $this->passwordTemporario    = $passwordTemporario;
      $this->tipo                  = $tipo;
      $this->email                 = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if ($this->tipo == 'inspetor') {
        $subject = 'Visa Garanhuns - Convite';
        return $this->to($this->email)
                    ->subject($subject)
                    ->view('email.conviteInspetor', [
                        'email' => $this->email,
        ]);
      } else {
        $subject = 'Visa Garanhuns - Convite';
        return $this->to($this->email)
                    ->subject($subject)
                    ->view('email.conviteAgente', [
                        'email' => $this->email,
        ]);
      }
      

        // return $this->view('email.convite');
    }
}
