<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('naoLogado.home_naologado');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Cadastro de empresa 
Route::post("/empresa/cadastro", "EmpresaController@store")->name("cadastrar.empresa");

Route::middleware(['OnlyAdmin'])->group(function () {
    Route::post("/coordenador/cadastro", "CoordenadorController@store")->name("cadastrar.coordenador");
});

// Grupo de rotas para coordenador
Route::middleware(['IsCoordenador'])->group(function () {
    Route::get('/home/coordenador', 'CoordenadorController@home')->name('home.coordenador');
    Route::post("/inspetor/cadastro", "InspetorController@store")->name("cadastrar.inspetor");
    Route::post("/agente/cadastro", "AgenteController@store")->name("cadastrar.agente");
    Route::post("/area/cadastro", "AreaController@store")->name("cadastrar.area");
    Route::post("/cnae/cadastro", "CnaeController@store")->name("cadastrar.cnae");
    Route::get("/listar/inspetores", "InspetorController@listarInspetores")->name("listar.inspetores");
    Route::get("/listar/agentes", "AgenteController@listarAgentes")->name("listar.agentes");
    //Supervisor
/*
    * Cadastrar/Editar/Deletar relatórios (Editar também relatórios criados pos outras pessoas)
    * Cadastrar/Editar/Deletar inspeções
    * Cadastrar/Editar/Deletar notificações de empresas
    * Consulta de denúncias
*/
});

// Grupo de rotas para empresa
Route::middleware(['IsEmpresa'])->group(function () {
    //Empresa - Gerente
    Route::get('/home/empresa', 'EmpresaController@home')->name('home.empresa');
/*
    * Cadastrar/Editar/Remove Responsável Técnico
    * Editar/Anexar dados da empresa
    * Consultar histórico de inspeções
    * Consultar notificações
*/
});

// Grupo de rotas para inspetor
Route::middleware(['IsInspetor'])->group(function () {
    Route::get('/home/inspetor', 'InspetorController@home')->name('home.inspetor');
/*
    (WEB)
    * Cadastrar/Editar/Deletar relatórios (Próprios)
    * Consultar suas inspeções
    * Cadastrar/Editar/Deletar notificações de empresas
    (APP)
    * Concluir inspeção (Mudar status de inspeção)
    * Cadastrar imagens
    * Cadastrar áudio
    * Listar documentos anexados por empresa 
*/
});

// Grupo de rotas para Agente
Route::middleware(['IsAgente'])->group(function () {
    Route::get('/home/agente', 'AgenteController@home')->name('home.agente');
    /*
        (WEB)
        * Cadastrar/Editar/Deletar relatórios (Próprios)
        * Consultar suas inspeções
        * Cadastrar/Editar/Deletar notificações de empresas
        (APP)
        * Concluir inspeção (Mudar status de inspeção)
        * Cadastrar imagens
        * Cadastrar áudio
        * Listar documentos anexados por empresa 
    */
});

// Grupo de rotas para responsável técnico
Route::middleware(['IsRespTecnico'])->group(function () {
    //Empresa - Responsável Técnico
/*
    * Editar/Anexar dados da empresa
    * Consultar histórico de inspeções
    * Consultar notificações
*/
});

//Adicionais
/*
    * Enviar dados de formulario de inspeção
*/