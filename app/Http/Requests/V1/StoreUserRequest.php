<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $validation = [
            'nombre' => ['required'],
            'direccion' => ['required'],
            'codigo_postal' => ['required'],
            'ciudad' => ['required'],
            'telefono' => ['required'],
            'email' => ['required'],
            'admin' => ['required'],
            'password' => [],
        ];
        return $validation;
    }

    protected function prepareForValidation() {
        $this->merge([
            'codigo_postal' => $this->codigoPostal
        ]);
    }
}
