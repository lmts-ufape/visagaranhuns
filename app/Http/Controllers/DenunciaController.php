<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denuncia;
use App\ImagemDenuncia;
use App\Empresa;
use App\Endereco;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
            'empresa'   => 'nullable|string',
            'endereco'  => 'nullable|string',
            'denuncia'  => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator);
        }

        if ($request->select_empresa != 'nenhum') {

            $empresa = Empresa::find($request->select_empresa);
            $endereco = Endereco::where('empresa_id', $request->select_empresa)->first();

            if($request->imagens == null){

                $denuncia = Denuncia::create([
                    'empresa'         => $empresa->nome,
                    'endereco'        => $endereco->rua . ',' . $endereco->numero . ',' . $endereco->bairro,
                    'denuncia'        => $request->denuncia,
                    'empresa_id'      => $empresa->id,
                    'status'          => "pendente",
                ]);
    
                session()->flash('success', 'Sua denúncia foi cadastrada!');
                return back();

            }else {

                $denuncia = Denuncia::create([
                    'empresa'         => $empresa->nome,
                    'endereco'        => $endereco->rua . ',' . $endereco->numero . ',' . $endereco->bairro,
                    'denuncia'        => $request->denuncia,
                    'empresa_id'      => $empresa->id,
                    'status'          => "pendente",
                ]);
                
                foreach ($request->imagens as $key) {

                    $fileImg = $key;
                    $pathImg = 'denuncias/' . $denuncia->id . '/';
                    $nomeImg = $key->getClientOriginalName();
            
                    Storage::putFileAs($pathImg, $fileImg, $nomeImg);

                    $imagemDenuncia = ImagemDenuncia::create([
                        'nome'         => $pathImg . $nomeImg,
                        'denuncias_id' => $denuncia->id,
                    ]);
                }

                session()->flash('success', 'Sua denúncia foi cadastrada!');
                return back();
            }
        }
        else {

            if($request->imagens == null){

                $denuncia = Denuncia::create([
                    'empresa'         => $request->empresa,
                    'endereco'        => $request->endereco,
                    'denuncia'        => $request->denuncia,
                    'empresa_id'      => null,
                    'status'          => "pendente",
                ]);
    
                session()->flash('success', 'Sua denúncia foi cadastrada!');
                return back();

            }else {

                $denuncia = Denuncia::create([
                    'empresa'         => $request->empresa,
                    'endereco'        => $request->endereco,
                    'denuncia'        => $request->denuncia,
                    'empresa_id'      => null,
                    'status'          => "pendente",
                ]);
                
                foreach ($request->imagens as $key) {

                    $fileImg = $key;
                    $pathImg = 'denuncias/' . $denuncia->id . '/';
                    $nomeImg = $key->getClientOriginalName();
            
                    Storage::putFileAs($pathImg, $fileImg, $nomeImg);

                    $imagemDenuncia = ImagemDenuncia::create([
                        'nome'         => $pathImg . $nomeImg,
                        'denuncias_id' => $denuncia->id,
                    ]);
                }
                session()->flash('success', 'Sua denúncia foi cadastrada!');
                return back();
            }
        }
    }
}
