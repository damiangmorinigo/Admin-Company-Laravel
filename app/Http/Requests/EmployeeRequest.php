<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'apellido'     => 'required',
            'id_company'     => 'required',
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
            'apellido.required'     => '(*) El apellido es requerido. Debe ingresarlo. ',
            'id_company.required'     => '(*) La compañia es requerido. Debe seleccionarla. ',
            
        ];
    }
}
