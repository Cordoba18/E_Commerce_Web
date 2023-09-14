<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
        // validamos los campos name, lastname, date, correo, password
        return [
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'date' => ['required'],
            'correo' => ['required', 'string', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
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
