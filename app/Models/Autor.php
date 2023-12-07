<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nombre',
    ];

    public function entrada() {
        return $this->hasMany(EntradaBlog::class, 'id_autor', 'id');
    }
}
