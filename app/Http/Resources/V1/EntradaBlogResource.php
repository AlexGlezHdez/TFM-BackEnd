<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntradaBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'titulo' => $this->titulo_entrada,
            'contenido' => $this->contenido,
            'imagen' => $this->imagen,
            'fechaPublicacion' => $this->fecha_publicacion,
            'autor' => new AutorResource($this->whenLoaded('autor'))
        ];
    }
}
