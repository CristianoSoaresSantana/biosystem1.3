<?php

use Illuminate\Database\Seeder;
use App\Models\Filial;

class FilialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filials = [
            ['razao_social' => 'Loja Cento', 'cnpj' => '22222222222222'],
            ['razao_social' => 'Americanas', 'cnpj' => '33333333333333']
        ];

        foreach($filials as $filial){
            Filial::create($filial);        
        }
    }
}
