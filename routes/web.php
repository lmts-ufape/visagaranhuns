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
        // dd('dkjbfkdsjbfskdj');
        if (Auth::user()->tipo == "coordenador") {
            return view('coordenador.home_coordenador');
        }
        elseif (Auth::user()->tipo == "empresa") {
            return redirect()->route('home.empresa');
        }
        elseif (Auth::user()->tipo == "inspetor") {
            return view('inspetor.home_inspetor');
        }
        elseif (Auth::user()->tipo == "agente") {
            return view('agente.home_agente');
        }
        elseif (Auth::user()->tipo == "rt") {
            return view('responsavel_tec.home_rt');
        }
    }
    else {
        return view('naoLogado.home_naologado');
    }
})->name("/");

Auth::routes();

// Completar cadastro de Inpetor
Route::get('/completar/cadastro/inspetor','InspetorController@create')->name('completar.cadastro.inspetor');
Route::post('/completar/cadastro/inspetor','InspetorController@store')->name('completar.cadastro.inspetor');

// Completar cadastro de Agente
Route::get('/completar/cadastro/agente','AgenteController@create')->name('completar.cadastro.agente');
Route::post('/completar/cadastro/agente','AgenteController@store')->name('completar.cadastro.agente');

//Cadastro de empresa
Route::post("/empresa/cadastro", "EmpresaController@store")->name("cadastrar.empresa");
Route::get("/home/cadastro/empresa", "EmpresaController@create")->name("home.cadastrar");

// Aviso de pendencia de empresa
Route::get("/confirma/cadastro", function () {
    return view('empresa/aviso_empresa');
})->name("confirma.cadastro");

// Rota para busca de cnaes
Route::get("/cnaes/busca", "CnaeController@busca")->name("cnae.busca");

Route::middleware(['OnlyAdmin'])->group(function () {
    Route::post("/coordenador/cadastro", "CoordenadorController@store")->name("cadastrar.coordenador");
});

Route::get("/empresa/lista/cnae",  "EmpresaController@ajaxCnaes")->name("ajax.lista.cnaes.comum");
Route::get("/emcostrucao",  function () {return view('em_construcao');})->name("emconstrucao");


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
    // Rota para avaliação de primeiro cadastro de usuario e empresa
    Route::post("/pagina/detalhes", "CoordenadorController@paginaDetalhes")->name("pagina.detalhes");
    Route::post("/julgar/cadastro", "CoordenadorController@julgar")->name("julgar.cadastro");


    Route::get("/empresa/listagem", "EmpresaController@index")->name("listagem.empresas");
    Route::get("/show/empresa", "EmpresaController@show")->name("mostrar.empresas");

    // Rotas para convidar Inspetores e agente
    Route::post("/convidar/inspetor", "CoordenadorController@convidarEmail")->name("convidar.inspetor");
    Route::post("/convidar/agente", "CoordenadorController@convidarEmail")->name("convidar.agente");
    //Supervisor
/*
    * Cadastrar/Editar/Deletar relatórios (Editar também relatórios criados pos outras pessoas)
    * Cadastrar/Editar/Deletar inspeções
    * Cadastrar/Editar/Deletar notificações de empresas
    * Consulta de denúncias
*/
    // Rota para localizar
    Route::get("/coordenador/localizar", "CoordenadorController@localizar");

    // Rota para gerenciar conteudo
    Route::get("/coordenador/gerenciarconteudo","ServicoController@index")->name("servico.index");
    Route::get("/coordenador/gerenciarconteudo/criar/servico","ServicoController@ajaxCriarServico");
    Route::get("/coordenador/gerenciarconteudo/deletar/servico","ServicoController@ajaxDeletarServico");
    Route::get("/coordenador/gerenciarconteudo/editar/servico","ServicoController@ajaxEditarServico");
    Route::get("/coordenador/gerenciarconteudo/editar/subir/servico","ServicoController@ajaxEditarSubirServico");
    Route::get("/coordenador/gerenciarconteudo/editar/descer/servico","ServicoController@ajaxEditarDescerServico");
    // Rota para gerenciar a secao
    Route::get("/coordenador/gerenciarconteudo/secao","ServicoController@indexSecao")->name("secao.index");
    Route::get("/coordenador/gerenciarconteudo/criar/secao","ServicoController@ajaxCriarSecao");
    Route::get("/coordenador/gerenciarconteudo/editar/secao","ServicoController@ajaxEditarSecao");
    Route::get("/coordenador/gerenciarconteudo/editar/subir/secao","ServicoController@ajaxEditarSubirSecao");
    Route::get("/coordenador/gerenciarconteudo/deletar/secao","ServicoController@ajaxDeletarSecao");
});

// Grupo de rotas para empresa
Route::middleware(['IsEmpresa'])->group(function () {
    //Empresa - Gerente
    Route::get('/home/empresa',                         'EmpresaController@home')->name('home.empresa');
    Route::get("/pagina/editar",                        "EmpresaController@edit")->name("editar.empresa");
    Route::post("/editar/empresa",                      "EmpresaController@editarEmpresa")->name("editar.empresa");
    Route::post("/empresa/arquivos",                    "EmpresaController@anexarArquivos")->name("anexar.arquivos");
    Route::get("/listar/arquivos",                      "EmpresaController@listarArquivos")->name("listar.arquivos");
    Route::get("/empresa/pagina/responsavelTecnico",    "RespTecController@create")->name("pagina.respTec");
    Route::post("/empresa/cadastro/responsavelTecnico", "RespTecController@store")->name("cadastrar.respTec");
    Route::get("/estabelecimento/adicionar/",           "EmpresaController@paginaCadastrarEmpresa")->name("pagina.adicionar.empresa");
    Route::get("/estabelecimento/perfil/",              "EmpresaController@showEmpresa")->name("pagina.mostrar.empresa");
    Route::get("/estabelecimento/documentacao/",        "EmpresaController@showDocumentacao")->name("pagina.mostrar.documentacao");
    Route::post("/empresa/cadastro/responsavelTecnico", "EmpresaController@adicionarEmpresa")->name("adicionar.empresa");
    Route::get("/listar/empresas/",                     "EmpresaController@listarEmpresas")->name("listar.empresas");
    Route::get("/estabelecimento/lista/cnae",           "EmpresaController@ajaxCnaes")->name("ajax.lista.cnaes");
    Route::get("/listar/responsavelTecnico",            "EmpresaController@listarResponsavelTec")->name("listar.responsavelTec");

    // Cadastro de Responsável Técnico
    Route::get('/cadastro/respTecnico','RespTecnicoController@create')->name('cadastrar.rt.pagina');
    Route::post('/cadastro/respTecnico','RespTecnicoController@store')->name('cadastrar.rt');

    // Encontrar item da checklist
    Route::get('/foundChecklist','EmpresaController@foundChecklist')->name('found.checklist');

    // Download de arquivos anexados
    Route::get('/download/arquivo',       'EmpresaController@downloadArquivo')->name('download.arquivo');

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
    Route::get('cadastrar/agente', function () {return view('agente/cadastrar_agente');})->name('cadastrar.agente');
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
    Route::get('/editar/dados', 'RespTecnicoController@edit')->name('editar.dados');
    Route::get('/home/rt', function () {return view('responsavel_tec/home_rt');})->name('home.rt');
    Route::post('/atualizar/rt','RespTecnicoController@update')->name('update.rt');
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
