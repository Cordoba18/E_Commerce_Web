<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buys extends Model
{
    use HasFactory;
    protected $table = 'compra';
    protected $fillable = [
        'id_user',
        'id_producto',
        'total',
        'cantidad',
        'id_metodo_pago',
        'factura_id',
        'tallas_id',
        'colores_id',
        'estados_id',
    ];

    public function factura(){
        return $this->belongsTo(Bill::class, 'factura_id');
    }
}
