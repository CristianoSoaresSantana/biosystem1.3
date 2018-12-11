<?php

use Illuminate\Database\Seeder;
use App\Models\Forma_pagto;

class FormaPagtosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forma_pagamentos = [
            ['forma_pagto' => 'a vista'],
            ['forma_pagto' => 'cheque'],
            ['forma_pagto' => 'cartão de credito'],
            ['forma_pagto' => 'cartão de debito']
        ];

        foreach($forma_pagamentos as $forma_pagamento){
            Forma_pagto::create($forma_pagamento);        
        }
    }
}
