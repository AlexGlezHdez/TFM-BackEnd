<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaBlog extends Model
{
    use HasFactory;

    protected $table = 'entradas_blog';

    protected $fillable = [
        'titulo_entrada',
        'imagen',
        'contenido',
        'fecha_publicacion',
        'id_autor',
    ];

    public function autor() {
        return $this->belongsTo(Autor::class, 'id_autor', 'id');
    }

}
