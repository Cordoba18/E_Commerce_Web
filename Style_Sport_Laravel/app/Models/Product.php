<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'precio',
        'descuento',
        'descripcion',
        'calificacion',
        'n_p_calificacion',
        'id_user',
        'estados_id',

    ];
}
