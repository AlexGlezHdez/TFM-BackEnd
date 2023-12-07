<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class EntradaBlogFilter extends Apifilter {
  protected $safeParams = [
    'titulo' => ['lk'],
    'fechaPublicacion' => ['eq', 'gt', 'lt'],
    'idAutor' => ['eq']
  ];

  protected $columnMap = [
    'titulo' => 'titulo_entrada',
    'fechaPublicacion' => 'fecha_publicacion',
    'idAutor' => 'id_autor'
  ];

}
