<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WihsList extends Model
{
    use HasFactory;

    protected $table = 'lista_deseos';

    protected $fillable = [
        'id_user',
        'id_producto',
        'estados_id',
    ];
}
