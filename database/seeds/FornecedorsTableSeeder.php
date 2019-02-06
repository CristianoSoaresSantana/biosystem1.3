<?php

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fornecedors = [
            ['razao_social' => 'FitWey', 'cnpj' => '1234567891234'],
            ['razao_social' => 'Laboratorio', 'cnpj' => '0000000000000']
        ];

        foreach($fornecedors as $fornecedor){
            Fornecedor::create($fornecedor);
        }
    }
}
