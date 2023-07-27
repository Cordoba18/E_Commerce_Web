<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartShop extends Model
{
    use HasFactory;

    protected $table = 'carrito_compras';

    protected $fillable = [
        'cantidad_producto',
        'total',
        'id_user',
        'id_producto',
        'estados_id',
        'tallas_id',
        'colores_id',
    ];
}
