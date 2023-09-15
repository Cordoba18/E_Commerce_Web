<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'factura';
    protected $fillable = [
        'total',
        'fecha',
        'id_user',
        'total_neto',
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
