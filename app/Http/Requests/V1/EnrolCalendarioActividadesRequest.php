<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class EnrolCalendarioActividadesRequest extends FormRequest
{

  public function authorize(): bool
  {
      $user = $this->user();
      return $user != null;
  }

  public function rules(): array
  {
      return [
          'id_actividad' => ['required'],
      ];
  }

      protected function prepareForValidation() {
      $this->merge([
          'id_actividad' => $this->idActividad,
          'id_usuario' => $this->idUsuario
      ]);
  }

}