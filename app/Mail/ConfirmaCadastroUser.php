<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Support\Facades\Mail;

class ConfirmaCadastroUser extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $empresa;
    private $decisao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\stdClass $user, $empresa, $decisao)
    {
        $this->user = $user;
        $this->empresa = $empresa;
        $this->decisao = $decisao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->decisao == "true") {

            $subject = 'Visa G - Aprovação de cadastro de usuário';
            return $this->to($this->user->email, $this->user->name)
                        ->subject($subject)
                        ->view('email.ConfirmaCadastroUsuario', [
                            'user' => $this->user,
                        ]);
        }
        else {
            $subject = 'Visa G - Reprovação de cadastro de usuário';
            return $this->to($this->user->email, $this->user->name)
                        ->subject($subject)
                        ->view('email.ReprovaCadastroUsuario', [
                            'user' => $this->user
                        ]);
        }
    }
}
