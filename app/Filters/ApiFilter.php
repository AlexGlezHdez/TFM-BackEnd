<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiFilter {

  protected $safeParams = [];

  protected $columnMap = [];

  protected $operatorMap = [
    'eq' => '=',
    'ne' => '!=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>=',
    'lk' => 'LIKE'
  ];

  public function transform(Request $request) {
    $eloQuery = [];

    foreach ($this->safeParams as $param => $operators) {
      $query = $request->query($param);

      if (!isset($query)) {
        continue;
      }

      $column = $this->columnMap[$param] ?? $param;

      foreach ($operators as $operator) {
        if (isset($query[$operator])) {
          if ($operator=='lk') {
            $eloQuery[] = [$column, $this->operatorMap[$operator], DB::raw('"%'.$query[$operator].'%"')];
          } else {
            $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
          }
        }
      }
    }

    return $eloQuery;
  }

}