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
            'institution.meal_morning_demand' => ['required', 'numeric', 'integer'],
            'institution.meal_afternoon_demand' => ['required', 'numeric', 'integer'],
            'institution.meal_night_demand' => ['required', 'numeric', 'integer'],
            'institution.phone' => 'required',
            
            'address.zipcode' => 'required',
            'address.state' => ['required', 'size:2'],
            'address.city' => 'required',
            'address.street' => 'required',
            'address.number' => ['required', 'numeric', 'integer'],
            'address.district' => 'required',
            'address.complement' => ['nullable', 'max:25']
        ];
    }
}
