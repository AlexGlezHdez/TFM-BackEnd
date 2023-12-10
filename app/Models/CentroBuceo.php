<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroBuceo extends Model
{
    use HasFactory;

    protected $table = 'centros_buceo';

    protected $fillable = [
        'nombre',
        'direccion',
        'accesible',
        'latitud',
        'longitud',
    ];
}
