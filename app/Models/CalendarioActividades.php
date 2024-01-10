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

    public function miembros() {
        return $this->belongsToMany(User::class, 'actividad_usuario', 'id_actividad_agendada', 'id_usuario');
    }
}
