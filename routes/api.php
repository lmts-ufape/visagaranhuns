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
Route::post("/download/inspecoes",  "ApiController@apiDonwloadInspecoes")->name("api.download.inspecoes");

//baixar dados da empresa

//baixar documentos
Route::post("/download/doc",  "ApiController@apiDownloadDoc")->name("api.download.doc");

//baixar img da pdf
Route::get("/donwload/img/pdf",  "ApiController@apiDownloadImagemPDF")->name("api.donwload.pdf");

//verifica img da inspecao
Route::post("/verifica/img",  "ApiController@apiVerifica")->name("api.verifica.img");

//salvar img da inspecao
Route::post("/save/img",  "ApiController@apiSaveImg")->name("api.save.img");

//salvar comentario da inspecao
Route::post("/save/comentario",  "ApiController@apiSaveComentario")->name("api.save.comentario");

//baixar img da inspecao
Route::post("/download/img",  "ApiController@apiDownloadImg")->name("api.download.img");

//atualizar dados
Route::post("/atualizar/aplicativo",  "ApiController@apiAtualizarApp")->name("api.atualizar.app");
