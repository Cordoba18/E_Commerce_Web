<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calification extends Model
{
    use HasFactory;
    protected $table = 'calificacion';
    protected $fillable = [
        'calificacion',
        'id_user',
        'id_producto',
    ];
}
