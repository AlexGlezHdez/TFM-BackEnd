<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaBlog extends Model
{
    use HasFactory;

    protected $table = 'entradas_blog';

    public function autor() {
        return $this->belongsTo(Autor::class, 'id_autor', 'id');
    }

}
