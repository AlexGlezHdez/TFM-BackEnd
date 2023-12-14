<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioCursos extends Model
{
    use HasFactory;

    protected $table = 'calendario_cursos';

    protected $fillable = [
        'id_curso',
        'fecha',
        'detalles',
    ];

    public function curso() {
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }
}
