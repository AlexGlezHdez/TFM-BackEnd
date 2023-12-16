<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActividadRequest extends FormRequest
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
                'titulo' => ['required'],
                'descripcion' => ['required'],
                'imagen' => ['required'],
                ];
        } else {
            return [
                'titulo' => ['sometimes', 'required'],
                'descripcion' => ['sometimes', 'required'],
                'imagen' => ['sometimes', 'required'],
                ];
        }
    }
}
