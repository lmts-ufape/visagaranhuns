<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        \App\Area::create([ 'nome' => 'Serviços de Ensino']);
        \App\Area::create([ 'nome' => 'Serviços de Saúde/Interesse a saúde/outros']);
        \App\Area::create([ 'nome' => 'Distribuidora de serviços de saúde']);
        \App\Area::create([ 'nome' => 'Caminhão pipa']);
        \App\Area::create([ 'nome' => 'Estação de tratamento de água']);
        \App\Area::create([ 'nome' => 'MEI']);
        \App\Area::create([ 'nome' => 'Distribuidora de serviços diversos']);
        \App\Area::create([ 'nome' => 'MEI/Serviço de alimentação']);
    }
}
