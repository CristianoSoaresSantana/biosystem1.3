<?php

use Illuminate\Database\Seeder;
use App\Models\Tipo_movimento;

class TipoMovimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_movimentos = [
            ['tipo_movimentacao' => 'entrada'],
            ['tipo_movimentacao' => 'transferencia'],
            ['tipo_movimentacao' => 'saida']
        ];

        foreach($tipo_movimentos as $tipo_movimento){
            tipo_movimento::create($tipo_movimento);
        }
    }
}
