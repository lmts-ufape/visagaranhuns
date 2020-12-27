<?php

use Illuminate\Database\Seeder;

class TipoDocRespSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tipodocresp::create([ 'nome' => 'Termo de compromisso e responsabilidade técnica', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Cédula profissional', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Certidão negativa de conselho', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Diploma do responsável técnico', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Registro da empresa no conselho do responsável técnico', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Manual de boas práticas', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Procedimento operacional padrão', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Checklist de inspeção', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Cronograma de treinamento de funcionários', 'validade' => '5']);
        \App\Tipodocresp::create([ 'nome' => 'Ata de treinamentos', 'validade' => '5']);
    }
}
