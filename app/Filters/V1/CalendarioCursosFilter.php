<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CalendarioCursosFilter extends Apifilter {
  protected $safeParams = [
    'titulo' => ['lk'],
    'fecha' => ['eq', 'gt', 'gte', 'lt', 'lte'],
  ];

  protected $columnMap = [
  ];
}
