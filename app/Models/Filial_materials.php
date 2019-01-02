<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Material;
use App\Models\Filial;

class Filial_materials extends Model
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $table = 'filial_materials';
    protected $fillable = ['filial_id', 'material_sku', 'quantidade', 'min', 'max', 'curvaABC', 'comissao', 'valor_venda', 'status'];
}
