<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class StoreProductCartShopping extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if (!auth()->check()) {
            return false; // El usuario no está autorizado, por lo tanto, devuelve false
        }

        return true;
    }

    protected function failedAuthorization()
    {
        // Redirigir al usuario a la vista de inicio de sesión con un mensaje de aviso
        Redirect::to('login')->with('credentials', 'Debe iniciar sesión para acceder al formulario.')->send();

        exit; // Asegúrate de detener la ejecución del código después de la redirección
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
        ];
    }
}
