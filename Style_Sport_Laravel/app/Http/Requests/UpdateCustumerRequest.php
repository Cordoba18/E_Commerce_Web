<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateCustumerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'passnow' => ['required', 'confirmed', Password::defaults()],
            'pass' => ['required', 'confirmed', Password::defaults()],
            'nid' => ['required', 'string', 'numeric', 'min:8', 'max:11'],
            'numberphone' =>['required', 'numeric', 'string', 'min:9', 'max:11'],
            'address' => ['required', 'string'],
        ];
    }

    public function messages()
    {
         // aqui editamos los mensajes que queremos mostrar
        return [
            'name.required' => 'el nombre es un valor requerido',
            'lastname.required' => 'el apellido es un valor requerido',
            'date.required' => 'la fecha es un valor requerido',
            'correo.required' => 'el correo es un valor requerido',
            'correo.email' => 'el correo debe ser un email valido',
            'password.required' => 'la contraseña es un valor requerido',
            'password.confirmed' => 'las contraseñas no son iguales',
        ];
    }
}
