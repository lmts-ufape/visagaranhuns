<?php

use Illuminate\Database\Seeder;

class CnaeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Cnae::create([ 'codigo' => '', 'descricao' => '', 'areas_id' => '']);
    }
}
