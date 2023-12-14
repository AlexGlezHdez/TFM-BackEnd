<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validation=[];

        $method = $this->method();

        if ($method == 'PUT') {
            $validation = [
                'nombre' => ['required'],
                'direccion' => ['required'],
                'codigo_postal' => ['required'],
                'ciudad' => ['required'],
                'telefono' => ['required'],
                'password' => ['required'],
                ];
        } else {
            $validation = [
                'nombre' => ['sometimes', 'required'],
                'direccion' => ['sometimes', 'required'],
                'codigo_postal' => ['sometimes', 'required'],
                'ciudad' => ['sometimes', 'required'],
                'telefono' => ['sometimes', 'required'],
                'password' => ['sometimes', 'required'],
                ];
        }

        if ($this->user()->tokenCan('admin')) {
            // Vamos a permitir los campos email y admin si el que modifica es un administrador
            $validation['email'] = ['sometimes', 'required'];
            $validation['admin'] = ['sometimes', 'required'];
        } else {
            // Y a prohibirlos si no lo es
//            $validation['email'] = ['prohibited'];
   //         $validation['admin'] = ['prohibited'];
        }

        return $validation;
    }
}
