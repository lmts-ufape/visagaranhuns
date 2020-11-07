<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denuncia;
use Illuminate\Support\Facades\Validator;

class DenunciaController extends Controller
{
    public function cadastrarDenuncia(Request $request)
    {

        $messages = [
            'required'  => 'O campo de :attribute deve ser preenchido!',
            'email'     => 'E-mail está incorreto!',
        ];

        $validator = Validator::make($request->all(), [
            'nome'      => 'string',
            'email'     => 'nullable|email',
            'telefone'  => 'nullable|string',
            'denuncia'  => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator);
        }

        $denuncia = Denuncia::create([
            'nome'            => $request->nome,
            'email'           => $request->email,
            'telefone'        => $request->telefone,
            'denuncia'        => $request->denuncia,
            'empresa_id'      => $request->empresa,
            'status'          => "pendente",
        ]);

        session()->flash('success', 'Sua denúncia foi cadastrada com sucesso!');
        return back();
    }
}
