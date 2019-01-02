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
            [ 'sku' => 'ss123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '00000000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'aa123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '1', 'cod_barra' => '33333343', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'qq123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '22222232', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'gg123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '11111121', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'bb123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '00000060', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'cc123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '1', 'cod_barra' => '33333373', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'dd123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '22222282', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'ee123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '11111191', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'ff123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '00000330', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'hh123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '1', 'cod_barra' => '33333443', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'ii123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '22222552', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'tt123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '11111661', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'rr123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '00000770', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'uu123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '1', 'cod_barra' => '33333883', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'oo123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '1', 'cod_barra' => '22222992', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'ww123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '22111111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'zz123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '22000000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'xx123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '2', 'cod_barra' => '44333333', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'nn123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '55222222', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'mm123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '66111111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'll123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '77000000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'kk123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '2', 'cod_barra' => '88333333', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'jj123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '99222222', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'pp123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '11991111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'yy123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '00880000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'he123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '2', 'cod_barra' => '33773333', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'vv123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '22552222', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'ab123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '11441111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'ac123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '00550000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'ad123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '2', 'cod_barra' => '33363333', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'ae123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '22252222', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'af123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '11131111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ],
            [ 'sku' => 'at123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '00080000', 'descricao' => 'colageno', 'image' => '', 'valor_compra' => '025.55', 'valor_revenda' => '050.99', 'status' => 'ativo' ],
            [ 'sku' => 'as123', 'tipo_material_id' => '2', 'forma_farmaceutica_id' => '2', 'fornecedor_id' => '2', 'cod_barra' => '33335333', 'descricao' => 'tribulus', 'image' => '', 'valor_compra' => '111.66', 'valor_revenda' => '156.87', 'status' => 'ativo' ],
            [ 'sku' => 'aq123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '22224222', 'descricao' => 'wey',      'image' => '', 'valor_compra' => '130.21', 'valor_revenda' => '161.54', 'status' => 'ativo' ],
            [ 'sku' => 'ak123', 'tipo_material_id' => '1', 'forma_farmaceutica_id' => '1', 'fornecedor_id' => '2', 'cod_barra' => '11113111', 'descricao' => 'forte',    'image' => '', 'valor_compra' => '140.25', 'valor_revenda' => '199.58', 'status' => 'ativo' ]
        ];

        foreach($materials as $material){
            Material::create($material);
        }
    }
}
