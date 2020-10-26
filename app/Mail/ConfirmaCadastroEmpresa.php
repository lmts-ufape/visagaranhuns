<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Empresa;
use Illuminate\Support\Facades\Mail;

class ConfirmaCadastroEmpresa extends Mailable
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
            $subject = 'Visa - Aprovação de cadastro de empresa';
            return $this->to($this->user->email, $this->user->name)
                    ->subject($subject)
                    ->view('email.ConfirmaCadastroEmpresa', [
                        'user' => $this->user,
                        'empresa' => $this->empresa,
                    ]);
        }
        else {
            $subject = 'Visa - Reprovação de cadastro de empresa';
            return $this->to($this->user->email, $this->user->name)
                    ->subject($subject)
                    ->view('email.ReprovaCadastroEmpresa', [
                        'user' => $this->user,
                        'empresa' => $this->empresa,
                    ]);
        }
        
    }
}
