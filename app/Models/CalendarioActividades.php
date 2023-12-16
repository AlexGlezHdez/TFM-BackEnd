<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioActividades extends Model
{
    use HasFactory;

    protected $table = 'calendario_actividades';

    protected $fillable = [
        'id_actividad',
        'fecha',
        'detalles',
        'plazas'
    ];

    public function actividad() {
        return $this->belongsTo(Actividad::class, 'id_actividad', 'id');
    }
}
