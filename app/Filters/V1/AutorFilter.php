<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AutorFilter extends Apifilter {

  protected $safeParams = [
    'nombre' => ['lk'],
  ];

  protected $columnMap = [
    'nombre' => 'nombre'
  ];

}
