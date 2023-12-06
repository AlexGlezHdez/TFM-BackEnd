<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaBlog extends Model
{
    use HasFactory;

    protected $table = 'entradas_blog';

    public function autores() {
        return $this->belongsTo(Autores::class);
    }

}
