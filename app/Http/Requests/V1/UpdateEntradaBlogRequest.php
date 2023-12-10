<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntradaBlogRequest extends FormRequest
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
                'titulo_entrada' => ['required'],
                'imagen' => ['required'],
                'contenido' => ['required'],
                'fecha_publicacion' => ['required'],
                'idAutor' => ['required'],
            ];
        } else {
            return [
                'titulo_entrada' => ['sometimes', 'required'],
                'imagen' => ['sometimes', 'required'],
                'contenido' => ['sometimes', 'required'],
                'fecha_publicacion' => ['sometimes', 'required'],
                'idAutor' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation() {
        $this->merge([
            'titulo_entrada' => $this->tituloEntrada,
            'fecha_publicacion' => $this->fechaPublicacion,
            'id_autor' => $this->idAutor
        ]);
    }
}
