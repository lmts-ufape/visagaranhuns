<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post("/login",  "ApiController@apiLogin")->name("api.login");

//atualizar o token 
Route::post("/refresh",  "ApiController@apiRefresh")->name("api.refresh");

//baixar inspecoes

//baixar dados da empresa

//baixar documentos

//enviar fotos


Route::get("/teste",  "ApiController@teste")->name("api.teste");