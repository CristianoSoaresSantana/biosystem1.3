<?php

use Illuminate\Database\Seeder;
use App\Models\Compra;

class ComprasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $compras = [
            [
                'num_doc' => '123345', 
                'filial_id' => '1',
                'tipo_mov_id' => '1',
                'fornecedor_id' => '1',
                'valor_nota' => '800.56'
            ],
            [
                'num_doc' => '987774', 
                'filial_id' => '2',
                'tipo_mov_id' => '1',
                'fornecedor_id' => '2',
                'valor_nota' => '1800.56'
            ]
        ];

        foreach($compras as $compra){
            Compra::create($compra);        
        }
    }
}
