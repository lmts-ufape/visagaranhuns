<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadastroRTcadastrado extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $empresaNome;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $email, $empresaNome)
    {
      $this->email                 = $email;
      $this->empresaNome           = $empresaNome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $subject = 'Visa G - Dados de login';
      return $this->to($this->email)
                  ->subject($subject)
                  ->view('email.respTec', [
                      'email' => $this->email,
                      'empresaNome' => $this->empresaNome,
      ]);
    }
}