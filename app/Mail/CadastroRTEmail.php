<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadastroRTEmail extends Mailable
{
    use Queueable, SerializesModels;
    // public $nomeUsuario;
    public $email;
    public $passwordTemporario;
    public $empresaNome;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $email, $passwordTemporario, $empresaNome)
    {
      // $this->nomeUsuario    = $nomeUsuario;
      $this->email                 = $email;
      $this->passwordTemporario    = $passwordTemporario;
      $this->empresaNome           = $empresaNome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $subject = 'Visa - Dados de login';
      return $this->to($this->email)
                  ->subject($subject)
                  ->view('email.conviteRespTecnico', [
                      'email' => $this->email,
                      'senha' => $this->passwordTemporario,
                      'empresaNome' => $this->empresaNome,
      ]);
    }
}