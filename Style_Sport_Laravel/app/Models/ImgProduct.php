<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    use HasFactory;

    protected $table = 'Imagenes_productos';

    protected $fillable = [
        'imagen',
        'id_producto',
        'estados_id',
    ];
}
