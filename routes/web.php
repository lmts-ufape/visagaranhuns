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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['OnlyAdmin'])->group(function () {
    Route::post("/supervisor/cadastro", "SupervisorController@store")->name("cadastro.supervisor");
});

Route::middleware(['IsCoordenador'])->group(function () {
    Route::post("/empresa/cadastro", "EmpresaController@store")->name("cadastrar.empresa");
    Route::post("/fiscal/cadastro", "FiscalController@store")->name("cadastrar.fiscal");
    Route::post("/area/cadastro", "AreaController@store")->name("cadastrar.area");
    //Supervisor
/*
    * Cadastrar/Editar/Deletar Fiscal
    * Cadastrar/Editar/Deletar Empresa
    * Cadastrar/Editar/Deletar Responsável Técnico ?
    * Cadastrar/Editar/Deletar Áreas
    * Cadastrar/Editar/Deletar cnaes de áreas
    * Cadastrar/Editar/Deletar relatórios (Editar também relatórios criados pos outras pessoas)
    * Cadastrar/Editar/Deletar inspeções
    * Cadastrar/Editar/Deletar notificações de empresas
    * Consulta de denúncias
*/
});

Route::middleware(['IsEmpresa'])->group(function () {
    //Empresa - Gerente
/*
    * Cadastrar/Editar/Remove Responsável Técnico
    * Editar/Anexar dados da empresa
    * Consultar histórico de inspeções
    * Consultar notificações
*/
});

Route::middleware(['IsFiscal'])->group(function () {
    //Fiscal
    Route::get("/area/fiscal", "FiscalController@index")->name("fiscal.area");
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