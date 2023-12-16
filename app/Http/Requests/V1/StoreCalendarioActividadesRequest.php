<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarioActividadesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fecha' => ['required'],
            'detalles' => ['required'],
            'plazas' => ['required'],
            'id_actividad' => ['required'],
        ];
    }

        protected function prepareForValidation() {
        $this->merge([
            'id_actividad' => $this->idActividad
        ]);
    }
}
