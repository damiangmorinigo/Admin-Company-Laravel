<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'     => 'required',
            'logo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'nombre.required'     => '(*) El nombre es requerido. Debe ingresarlo. ',
            'logo.required'     => '(*) El logo es requerido. Debe ingresarlo. ',
            'logo.mimes'        => '(*) Error en el formato, los permitidos son jpeg,png,jpg,gif,svg. ',
            'logo.image'        => '(*) El archivo ingresado debe ser una imagen. ',
            'logo.dimensions'          => '(*) La imagen debe tener una dimensión mínima de 100x100. ',
        ];
    }
}
