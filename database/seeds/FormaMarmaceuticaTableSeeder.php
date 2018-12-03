<?php

use Illuminate\Database\Seeder;
use App\Models\Forma_farmaceutica;

class FormaFarmaceuticasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forma_farmaceuticas = [
            ['forma_farmaceutica' => 'Pote'],
            ['forma_farmaceutica' => 'Capsulas']
        ];

        foreach($forma_farmaceuticas as $forma_farmaceutica){
            Forma_farmaceutica::create($forma_farmaceutica);        
        }
    }
}
