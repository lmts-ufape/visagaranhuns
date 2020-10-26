<?php

use Illuminate\Database\Seeder;

class TipoDocEmpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tipodocempresa::create([ 'nome' => 'Requerimento Preenchido', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'CNPJ', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Contrato Social ou Registro de Firma Individual ou Certificado MEI', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'RG', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'CPF', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Atestado de Regularidade do Corpo de Bombeiros', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Licença Anterior', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Licença Sanitaria', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Certificado de Detetizadora', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'IPTU Quitado', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Licença Adagro', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Licença Ambiental', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Laudo de Água Microbiológico', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Taxa de Vigilância Sanitária', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Taxa de Serviço', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Plano de Gerenciamento de Resíduos de Serviços de Saúde - PGRSS', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Cadastro Nacional de Estabelecimentos de Saúde - CNESS', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Projeto Arquitetônico Aprovado pela APEVISA', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Certificado do Curso de Higiene e Manipulação de Alimentos', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'AFE/AE', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'RG dos Sócios', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'CPF dos Sócios', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Declaração dos Carros PIPA na Empresa', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Certificado de Registro e Licenciamento de Veículos - CRLV', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Declaração da Fonte', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Registro da ANTT', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'CNH', 'validade' => '5']);
        \App\Tipodocempresa::create([ 'nome' => 'Declaração do Material de Revestimento Interno do Tanque', 'validade' => '5']);

    }
}
