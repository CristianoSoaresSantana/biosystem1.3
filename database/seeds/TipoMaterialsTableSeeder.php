<?php

use Illuminate\Database\Seeder;
use App\Models\Tipo_material;

class TipoMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_materials = [
            ['tipo_material' => 'manipulado'],
            ['tipo_material' => 'industrializado']
        ];

        foreach($tipo_materials as $tipo_material){
            Tipo_material::create($tipo_material);        
        }
    }
}
