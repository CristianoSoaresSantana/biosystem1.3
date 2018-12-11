<?php

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            [ 
            'sku'                   => 'ss123', 
            'tipo_material_id'      => '1', 
            'forma_farmaceutica_id' => '1', 
            'cod_barra'             => '00000000', 
            'descricao'             => 'colageno', 
            'image'                 => '', 
            'valor_compra'          => '12', 
            'valor_revenda'           => '12', 
            'status'                => 'ativo'
            ],
            [ 
            'sku'                   => 'aa123', 
            'tipo_material_id'      => '2', 
            'forma_farmaceutica_id' => '2', 
            'cod_barra'             => '33333333', 
            'descricao'             => 'tribulus', 
            'image'                 => '', 
            'valor_compra'          => '11', 
            'valor_revenda'           => '15', 
            'status'                => 'inativo'
            ],
            [ 
            'sku'                   => 'qq123', 
            'tipo_material_id'      => '1', 
            'forma_farmaceutica_id' => '1', 
            'cod_barra'             => '22222222', 
            'descricao'             => 'wey', 
            'image'                 => '',
            'valor_compra'          => '13',
            'valor_revenda'           => '16',
            'status'                => 'inativo'
            ],
            [ 
            'sku'                   => 'gg123', 
            'tipo_material_id'      => '1', 
            'forma_farmaceutica_id' => '1', 
            'cod_barra'             => '11111111', 
            'descricao'             => 'forte', 
            'image'                 => '',
            'valor_compra'          => '14', 
            'valor_revenda'           => '19', 
            'status'                => 'ativo'
            ]
        ];

        foreach($materials as $material){
            Material::create($material);        
        }
    }
}
