<?php

namespace App\Http\Requests\Secretary\Food;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $foodUnits = collect(config('enums.food_units'))->pluck('key')->toArray();

        $uniqueFoodRule = Rule::unique('foods', 'name')->where(function($query){
            return $query->where('unit', $this->food['unit']);
        })
        ->ignore(request()->route()->parameter('food'));

        return [
            'food.name' => ['required', $uniqueFoodRule],
            'food.unit' => ['required', Rule::in($foodUnits)]
        ];
    }

    public function attributes()
    {
        return [
            'food.name' => 'nome',
            'food.unit' => 'unidade de medida'
        ];
    }

    public function messages()
    {
        return [
            'food.name.unique' => 'O campo nome já está sendo utilizado com essa unidade de medida.'
        ];
    }
}
