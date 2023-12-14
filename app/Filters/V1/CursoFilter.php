<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CursoFilter extends Apifilter {

  protected $safeParams = [
    'titulo' => ['lk'],
  ];

  protected $columnMap = [
  ];

}
