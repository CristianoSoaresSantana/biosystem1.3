<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use App\Models\Venda;

class Forma_pagto extends Model
{
    use Notifiable;
    
    public $timestamps = true;

    protected $table = 'forma_pagtos';
    protected $fillable = ['forma_pagto'];


    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($forma_pagamento = null)
    {
        if(!$forma_pagamento)
        {
            return $this->get();
        }
        else
        {
            return $this->where('forma_pagto', 'LIKE', "%{$forma_pagamento}%")->get();
        }
    }

    // /**
    //  * relacionamento 1:M, pois uma forma_pagamento é caracteristica de muitos
    //  * vendas e compras e um venda ou compra só pode ter um forma_pagamento.
    //  */
    // public function vendas()
    // {
    //     return $this->hasMany(Vendas::class);
    // }
}
