<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(FilialsTableSeeder::class);
        // $this->call(FornecedorsTableSeeder::class);
        // $this->call(SetorsTableSeeder::class);
        // $this->call(TipoMaterialsTableSeeder::class);
        // $this->call(FormaFarmaceuticasTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(ClientesTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(TipoMovimentosTableSeeder::class);
        $this->call(FormaPagtosTableSeeder::class);
        // $this->call(ComprasTableSeeder::class);
        // $this->call(VendasTableSeeder::class);
    }
}
