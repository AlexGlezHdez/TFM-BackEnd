<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UserFilter extends Apifilter {

  protected $safeParams = [
    'nombre' => ['lk'],
  ];

  protected $columnMap = [
//    'nombre' => 'nombre'
    'codigoPostal' => 'codigo_postal'

  ];

}
