<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    /*
    *   FUNCAO: Funcao para verificar se o usuario esta cadastrado no sistema
    *   ENTRADA: nome, senha
    *   RETURN: id, nome, email e senha
    */
    public function apiLogin(Request $request){
        $resultados = User::where('email','=',$request->email)->get();
        $output = '';
        $status = 'false';
        $token = '';
        foreach($resultados as $item){
            if(Hash::check($request->password ,$item->password) == true){
                $output =  $resultados;
                $token = Str::random(60);
                $status = 'true';

                $resultadoAtual = User::where('email','=',$request->email)->first();
                $resultadoAtual->remember_token = $token;
                $resultadoAtual->save();
            }
        }
        $data = array(
            'success'   => $status,
            'table_data' => $output,
            'token' => $token,
        );
        echo json_encode($data);
    }
    /*
    *   FUNCAO: Funcao para atualizar o token
    *   ENTRADA: token
    *   RETURN: token
    */
    public function apiRefresh(Request $request){
        $resultados = User::where('remember_token','=',$request->token)->first();
        $output = '';
        $status = 'false';
        $token = '';
        if(isset($resultados)==1){
            $output =  $resultados;
            $token = Str::random(60);
            $status = 'true';

            $resultadoAtual = User::where('remember_token','=',$request->token)->first();
            $resultadoAtual->remember_token = $token;
            $resultadoAtual->save();
        }
        $data = array(
            'success'   => $status,
            'table_data' => $output,
            'token' => $token,
        );
        echo json_encode($data);
    }
    public function teste(){
        return 10;
    }
}
