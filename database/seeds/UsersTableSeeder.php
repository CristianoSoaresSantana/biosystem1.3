<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'João Luis', 
                'email' => 'jj@ll.com',
                'password' => bcrypt('123456'),
                'filial_id' => 1,
                'setor_id' => 1,
                'cpf' => '00000000000',
                'data_nascimento' => date('2018-02-06'),
                'celular' => '31988887777',
                'celular_recado' => '31933332222',
                'endereco' => 'rua fulano, numero 95, bairro: chacara'
            ],
            [
                'name' => 'Luis Sergio', 
                'email' => 'll@ss.com',
                'password' => bcrypt('123456'),
                'filial_id' => 2,
                'setor_id' => 2,
                'cpf' => '11111111111',
                'data_nascimento' => date('2018-02-06'),
                'celular' => '31944447777',
                'celular_recado' => '31966662222',
                'endereco' => 'rua siclano, numero 95, bairro: chacara'
            ]
        ];

        foreach($users as $user){
            User::create($user);        
        }
    }
}
