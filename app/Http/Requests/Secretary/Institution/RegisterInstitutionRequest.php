<?php

namespace App\Http\Requests\Secretary\Institution;

use Illuminate\Foundation\Http\FormRequest;

class RegisterInstitutionRequest extends FormRequest
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
            'institution.name' => 'required',
            'institution.meal_morning_demand' => ['required', 'numeric', 'integer', 'min:1', 'max:5'],
            'institution.meal_afternoon_demand' => ['required', 'numeric', 'integer', 'min:1', 'max:5'],
            'institution.meal_night_demand' => ['required', 'numeric', 'integer', 'min:1', 'max:5'],
            'institution.phone' => ['required', 'min:14', 'max:15'],
            
            'address.zipcode' => 'required',
            'address.state' => ['required', 'size:2'],
            'address.city' => 'required',
            'address.street' => 'required',
            'address.number' => ['required', 'numeric', 'integer'],
            'address.district' => 'required',
            'address.complement' => ['nullable', 'max:25']
        ];
    }

    public function attributes()
    {
        return [
            'institution.name' => 'nome da instituição',
            'institution.meal_morning_demand' => 'demanda da manhã',
            'institution.meal_afternoon_demand' => 'demanda da tarde',
            'institution.meal_night_demand' => 'demanda da noite',
            'institution.phone' => 'telefone',
            
            'address.zipcode' => 'CEP',
            'address.state' => 'UF',
            'address.city' => 'cidade',
            'address.street' => 'logradouro',
            'address.number' => 'número',
            'address.district' => 'bairro',
            'address.complement' => 'complemento'
        ];
    }
}
