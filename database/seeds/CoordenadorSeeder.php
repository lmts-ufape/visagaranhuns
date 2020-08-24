<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoordenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'coordenador',
            'email' => 'coordenador@teste.com',
            'password' => Hash::make('123456'),
            'tipo' => 'coordenador'
        ]);

        \App\User::create([
            'name' => 'empresa',
            'email' => 'empresa@teste.com',
            'password' => Hash::make('123456'),
            'tipo' => 'empresa'
        ]);

        \App\User::create([
            'name' => 'empresa 2',
            'email' => 'empresa2@teste.com',
            'password' => Hash::make('123456'),
            'tipo' => 'empresa'
        ]);

        \App\Empresa::create([
            'cnpjcpf' => '10325647899',
            'status_inspecao' => 'pendente',
            'status_cadastro' => 'pendente',
            'tipo' => 'mei',
            'user_id' => '2',
        ]);

        \App\Empresa::create([
            'cnpjcpf' => '10325647899',
            'status_inspecao' => 'pendente',
            'status_cadastro' => 'pendente',
            'tipo' => 'mei',
            'user_id' => '3',
        ]);

        \App\User::create([
            'name' => 'inspetor',
            'email' => 'inspetor@teste.com',
            'password' => Hash::make('123456'),
            'tipo' => 'inspetor'
        ]);
        \App\User::create([
            'name' => 'agente',
            'email' => 'agente@teste.com',
            'password' => Hash::make('123456'),
            'tipo' => 'agente'
        ]);
        
        \App\CnaeEmpresa::create([ 'empresa_id' => '1', 'cnae_id' => '1' ]);
        \App\CnaeEmpresa::create([ 'empresa_id' => '1', 'cnae_id' => '2' ]);
        \App\CnaeEmpresa::create([ 'empresa_id' => '1', 'cnae_id' => '3' ]);
        \App\CnaeEmpresa::create([ 'empresa_id' => '2', 'cnae_id' => '3' ]);

        
    }
}
