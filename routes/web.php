<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        if (Auth::user()->tipo == "coordenador") {
            return view('coordenador.home_coordenador');
        }
        elseif (Auth::user()->tipo == "empresa") {
            return view('empresa.home_empresa');
        }
        elseif (Auth::user()->tipo == "inspetor") {
            return view('inspetor.home_inspetor');
        }
        elseif (Auth::user()->tipo == "agente") {
            return view('agente.home_agente');
        }
    }
    else {
        return view('naoLogado.home_naologado');
    }
});

Auth::routes();

//Cadastro de empresa
Route::post("/empresa/cadastro", "EmpresaController@store")->name("cadastrar.empresa");
Route::get("/home/cadastro/empresa", "EmpresaController@create")->name("home.cadastrar");

// Rota para busca de cnaes
Route::get("/cnaes/busca", "CnaeController@busca")->name("cnae.busca");

Route::middleware(['OnlyAdmin'])->group(function () {
    Route::post("/coordenador/cadastro", "CoordenadorController@store")->name("cadastrar.coordenador");
});

// Grupo de rotas para coordenador
Route::middleware(['IsCoordenador'])->group(function () {
    Route::get('/home/coordenador', 'CoordenadorController@home')->name('home.coordenador');
    Route::post("/inspetor/cadastro", "InspetorController@store")->name("cadastrar.inspetor");
    Route::get("/inspetor/paginaCadastro", "InspetorController@create")->name("pagina.inspetor");
    Route::post("/agente/cadastro", "AgenteController@store")->name("cadastrar.agente");
    Route::get("/agente/paginaCadastro", "AgenteController@create")->name("pagina.agente");
    Route::post("/area/cadastro", "AreaController@store")->name("cadastrar.area");
    Route::get("/area/paginaCadastro", "AreaController@create")->name("pagina.area");
    Route::get("/area/listagem", "AreaController@index")->name("listagem.area");
    Route::post("/cnae/cadastro", "CnaeController@store")->name("cadastrar.cnae");
    Route::get("/cnae/paginaCadastro", "CnaeController@create")->name("pagina.cnae");
    Route::get("/cnae/listagem", "CnaeController@index")->name("listagem.cnae");
    Route::get("/listar/inspetores", "InspetorController@listarInspetores")->name("listar.inspetores");
    Route::get("/listar/agentes", "AgenteController@listarAgentes")->name("listar.agentes"); //requerimento_coordenador

    //Tela de Requerimento
    Route::get("/requerimento/inspetor", "CoordenadorController@listarRequerimentoInspetorEAgente")->name("pagina.requerimento");
    Route::get("/requerimento", "CoordenadorController@ajaxListarRequerimento")->name("lista.requerimento");

    // Listar e baixar arquivos de uma empresa
    Route::get("/empresa/arquivos", "EmpresaController@listarArquivos")->name("empresa.arquivos");
    Route::get("/baixar/arquivos", "EmpresaController@baixarArquivos")->name("baixar.arquivos");
    // Rota para listar empresas com cadastro pendentes
    Route::get("/cadastros/pendentes", "CoordenadorController@listarPendente")->name("listar.cadastroPendente");
    // Rota para avaliação de cadastro de empresa
    Route::get("/pagina/detalhes", "CoordenadorController@paginaDetalhes")->name("pagina.detalhes");
    Route::get("/empresa/listagem", "EmpresaController@index")->name("listagem.empresas");
    Route::get("/show/empresa", "EmpresaController@show")->name("mostrar.empresas");
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
    Route::get('/home/empresa',                         'EmpresaController@home')->name('home.empresa');
    Route::get("/pagina/editar",                        "EmpresaController@edit")->name("editar.empresa");
    Route::post("/editar/empresa",                      "EmpresaController@editarEmpresa")->name("editar.empresa");
    Route::post("/empresa/arquivos",                    "EmpresaController@anexarArquivos")->name("arquivos.empresa");
    Route::get("/listar/arquivos",                      "EmpresaController@listarArquivos")->name("listar.arquivos");
    Route::get("/empresa/pagina/responsavelTecnico",    "RespTecController@create")->name("pagina.respTec");
    Route::post("/empresa/cadastro/responsavelTecnico", "RespTecController@store")->name("cadastrar.respTec");
    Route::get("/estabelecimento/adicionar/",           "EmpresaController@paginaCadastrarEmpresa")->name("pagina.adicionar.empresa");
    Route::get("/estabelecimento/perfil/",              "EmpresaController@showEmpresa")->name("pagina.mostrar.empresa");
    Route::post("/empresa/cadastro/responsavelTecnico", "EmpresaController@adicionarEmpresa")->name("adicionar.empresa");
    Route::get("/listar/empresas/",                     "EmpresaController@listarEmpresas")->name("listar.empresas");
    Route::get("/estabelecimento/lista/cnae",           "EmpresaController@ajaxCnaes")->name("ajax.lista.cnaes");


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
