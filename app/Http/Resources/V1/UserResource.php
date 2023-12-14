<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'codigoPostal' => $this->codigo_postal,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'admin' => $this->admin
        ];
    }
}