<?php

use Illuminate\Database\Seeder;
use App\Models\Venda;

class VendasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendas = [
            [
                'user_id' => '1',
                'filial_id' => '1',
                'cliente_id' => '1',
                'tipo_mov_id' => '1',
                'valor_total' => '800.56'
            ],
            [
                'user_id' => '1',
                'filial_id' => '1',
                'cliente_id' => '1',
                'tipo_mov_id' => '1',
                'valor_total' => '800.56'
            ],
            [
                'user_id' => '2',
                'filial_id' => '2',
                'cliente_id' => '2',
                'tipo_mov_id' => '2',
                'valor_total' => '800.56'
            ],
            [
                'user_id'     => '2',
                'filial_id'   => '2',
                'cliente_id'  => '2',
                'tipo_mov_id' => '2',
                'valor_total' => '800.56'
            ]
        ];

        foreach($vendas as $vendas){
            Venda::create($vendas);        
        }
    }
}
