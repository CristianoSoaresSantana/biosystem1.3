<?php

use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setors = [
            ['setor' => 'vendas'],
            ['setor' => 'call-center']
        ];

        foreach($setors as $setor){
            Setor::create($setor);
        }
    }
}
