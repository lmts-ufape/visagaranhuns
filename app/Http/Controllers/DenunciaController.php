<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denuncia;
use App\ImagemDenuncia;
use App\Empresa;
use App\Endereco;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class DenunciaController extends Controller
{
    public function cadastrarDenuncia(Request $request)
    {

        $messages = [
            'required'  => 'O campo de :attribute deve ser preenchido!',
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

        if ($request->select_empresa == null) {
            session()->flash('error', 'A empresa não foi informada!');
            return back();            
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

                    $ext = strtolower($key->getClientOriginalExtension());
                    if(!in_array($ext, array("jpg", "png", "jpeg", "bmp"))){
                        session()->flash('error', 'O arquivo ou um dos arquivos anexados não é uma imagem. Utilize imagens no formato: jpg, png, jpeg, bmp.');
                        return back();
                    }

                    $fileImg = $key;
                    $pathImg = 'denuncias/' . $denuncia->id . '/';
                    $nomeImg = $key->getClientOriginalName();

                    Image::configure(array('driver' => 'imagick'));
                    $img = Image::make($fileImg)->resize(640, 480);
                    // $imgNome = $img->getClientOriginalName();

                    Storage::put('denuncias/' . $denuncia->id . '/' . $nomeImg, $img->encode());

            
                    // Storage::putFileAs($pathImg, $img, $nomeImg);

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

                if ($request->empresa == null || $request->endereco == null) {
                    session()->flash('error', 'O campo "Empresa" ou "Endereco" não foi passado!');
                    return back();
                }

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

                if ($request->empresa == null || $request->endereco == null) {
                    session()->flash('error', 'O campo "Empresa" ou "Endereco" não foi passado!');
                    return back();
                }

                $denuncia = Denuncia::create([
                    'empresa'         => $request->empresa,
                    'endereco'        => $request->endereco,
                    'denuncia'        => $request->denuncia,
                    'empresa_id'      => null,
                    'status'          => "pendente",
                ]);
                
                foreach ($request->imagens as $key) {

                    $ext = strtolower($key->getClientOriginalExtension());
                    if(!in_array($ext, array("jpg", "png", "jpeg", "bmp"))){
                        session()->flash('error', 'O arquivo ou um dos arquivos anexados não é uma imagem. Utilize imagens no formato: jpg, png, jpeg, bmp.');
                        return back();
                    }

                    $fileImg = $key;
                    $pathImg = 'denuncias/' . $denuncia->id . '/';
                    $nomeImg = $key->getClientOriginalName();

                    Image::configure(array('driver' => 'imagick'));
                    $img = Image::make($fileImg)->resize(640, 480);
                    // $imgNome = $img->getClientOriginalName();

                    Storage::put('denuncias/' . $denuncia->id . '/' . $nomeImg, $img->encode());

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
