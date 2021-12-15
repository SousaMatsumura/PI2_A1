<?php

namespace App\Http\Requests\School\Institution;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Phone;
use App\Rules\Zipcode;
use Illuminate\Validation\Rule;
use Auth;

class InstitutionRequest extends FormRequest
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
        $states = collect(config('enums.states'))->pluck('key')->toArray();

        return [
            'institution.name' => ['required', Rule::unique('institutions', 'name')->ignore(Auth::user()->institution_id)],
            'institution.phone' => ['required', new Phone()],
            'institution.students' => ['required', 'numeric'],
            'address.zipcode' => ['required', new Zipcode()],
            'address.street' => ['required'],
            'address.number' => ['required'],
            'address.district' => ['required'],
            'address.city' => ['required'],
            'address.state' => ['required', Rule::in($states)],
            'address.complememt' => ['nullable', 'max:25']
        ];
    }

    public function attributes()
    {
        return [
            'institution.name' => 'nome',
            'institution.phone' => 'telefone',
            'institution.students' => 'alunos',
            'address.zipcode' => 'CEP',
            'address.street' => 'rua',
            'address.number' => 'número',
            'address.district' => 'bairro',
            'address.city' =>  'cidade',
            'address.state' => 'UF',
            'address.complement' => 'complemento'
        ];
    }
}
