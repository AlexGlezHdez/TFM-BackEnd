<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
//    public $collects = UserResource::class;

    public function toArray(Request $request): array
    {
      return parent::toArray($request);
    }

}
