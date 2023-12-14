<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'duracion',
    ];

    public function agenda() {
        return $this->hasMany(CalendarioCursos::class, 'id_curso', 'id');
    }
}
