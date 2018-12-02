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
        Filial::create([
            'razao_social' => 'Loja Eldorado',
            'cnpj' => '1234567891234',
        ]);        
    }
}
