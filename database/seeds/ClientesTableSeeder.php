<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesTableSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = [
            [
                'nome' => 'Roberto Araujo',
                'email' => 'jj@ll.com',
                'cpf' => '00000000000',
                'celular' => '31988887777',
                'celular_recado' => '31933332222',
                'endereco' => 'rua fulano, numero 95, bairro: chacara'
            ],
            [
                'nome' => 'Maria João',
                'email' => 'll@ss.com',
                'cpf' => '11111111111',
                'celular' => '31944447777',
                'celular_recado' => '31966662222',
                'endereco' => 'rua siclano, numero 95, bairro: chacara'
            ]
        ];

        foreach($clientes as $cliente){
            Cliente::create($cliente);
        }
    }
}
