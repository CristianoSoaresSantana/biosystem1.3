<?php

use Illuminate\Database\Seeder;
use App\Models\Filial_materials;

class FilialMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estoques = [
            ['filial_id' => '1', 'material_sku' => 'nn123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'vv123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'jj123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ii123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'dd123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'aq123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ae123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ad123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'af123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'as123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'at123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'pp123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'rr123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ss123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'hh123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'll123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'mm123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'gg123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'he123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ee123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'cc123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'bb123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ac123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '1', 'material_sku' => 'ab123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],

            ['filial_id' => '2', 'material_sku' => 'nn123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'vv123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'jj123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ii123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'dd123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'aq123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ae123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ad123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'af123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'as123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'at123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'pp123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'rr123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ss123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'hh123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'll123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'mm123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'gg123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'he123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ee123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'cc123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'bb123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ac123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo'],
            ['filial_id' => '2', 'material_sku' => 'ab123', 'min' => '10', 'max' => '200', 'curvaABC' => 'a', 'comissao' => '1.5', 'valor_venda' => '152.65', 'status' => 'ativo']
        ];
        foreach($estoques as $estoque){
            Filial_materials::create($estoque);
        }
    }
}
