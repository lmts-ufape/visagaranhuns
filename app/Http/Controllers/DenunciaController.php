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
            // 'email'     => 'E-mail está incorreto!',
            'string'    => 'O campo :attribute deve conter apenas texto!',
        ];

        $validator = Validator::make($request->all(), [
            // 'nome'      => 'string',
            // 'email'     => 'nullable|email',
            // 'telefone'  => 'nullable|string',
            'empresa'   => 'required|string',
            'endereco'  => 'required|string',
            'denuncia'  => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator);
        }

        if ($request->select_empresa == 'nenhum' || $request->select_empresa == null) {
            $denuncia = Denuncia::create([
                // 'nome'            => $request->nome,
                // 'email'           => $request->email,
                // 'telefone'        => $request->telefone,
                'empresa'         => $request->empresa,
                'endereco'        => $request->endereco,
                'denuncia'        => $request->denuncia,
                'empresa_id'      => null,
                'status'          => "pendente",
            ]);

            session()->flash('success', 'Sua denúncia foi cadastrada!');
            return back();
        }
        else {
            $denuncia = Denuncia::create([
                // 'nome'            => $request->nome,
                // 'email'           => $request->email,
                // 'telefone'        => $request->telefone,
                'empresa'         => $request->empresa,
                'endereco'        => $request->endereco,
                'denuncia'        => $request->denuncia,
                'empresa_id'      => $request->select_empresa,
                'status'          => "pendente",
            ]);

            session()->flash('success', 'Sua denúncia foi cadastrada!');
            return back();
        }
    }
}
