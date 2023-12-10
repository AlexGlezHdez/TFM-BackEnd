<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CentroBuceoFilter extends Apifilter {
  protected $safeParams = [
    'nombre' => ['lk'],
    'accesible' => ['eq']
  ];

  protected $columnMap = [
  ];
}
