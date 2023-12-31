<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCentroBuceoRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'nombre' => ['required'],
                'direccion' => ['required'],
                'accesible' => ['required', 'boolean'],
                'latitud' => ['required','numeric'],
                'longitud' => ['required','numeric'],
            ];
        } else {
            return [
                'nombre' => ['sometimes', 'required'],
                'direccion' => ['sometimes', 'required'],
                'accesible' => ['sometimes', 'required', 'boolean'],
                'latitud' => ['sometimes', 'required','numeric'],
                'longitud' => ['sometimes', 'required','numeric'],
            ];
        }
    }
}
