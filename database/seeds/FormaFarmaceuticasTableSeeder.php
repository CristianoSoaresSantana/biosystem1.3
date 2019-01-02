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
            ['forma_farmaceutica' => 'Capsulas'],
            ['forma_farmaceutica' => 'Creme'],
            ['forma_farmaceutica' => 'Gel'],
            ['forma_farmaceutica' => 'Loção'],
            ['forma_farmaceutica' => 'Pomada'],
            ['forma_farmaceutica' => 'Sachê'],
            ['forma_farmaceutica' => 'Sabonete'],
            ['forma_farmaceutica' => 'Solução'],
            ['forma_farmaceutica' => 'Esmalte'],
            ['forma_farmaceutica' => 'Xarope'],
            ['forma_farmaceutica' => 'Outros']
        ];

        foreach($forma_farmaceuticas as $forma_farmaceutica){
            Forma_farmaceutica::create($forma_farmaceutica);
        }
    }
}
