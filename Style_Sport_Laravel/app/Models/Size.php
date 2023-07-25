<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'tallas';

    protected $fillable = [
        'cantidad',
        'talla',
        'id_producto',
        'estados_id',
    ];
}
