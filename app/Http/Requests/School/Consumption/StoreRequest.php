<?php

namespace App\Http\Requests\School\Consumption;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreRequest extends FormRequest
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
        $rules = [
            'consumption.created_at' => ['required', 'date_format:d/m/Y'],
        ];

        $foodRecords = Auth::user()->institution->FoodRecords()->groupByFood()->get();

        foreach(request()->foods as $key => $value) {

            $maxAmount = $foodRecords->where('food_id', $key)->first()->amount_remaining;
            
            $rules['foods.'.$key.'.amount_consumed'] = ['nullable', 'numeric', 'min:0', 'max:'.$maxAmount.''];

        }

        return $rules;
    }

    public function attributes()
    {

        $attributes = [
            'consumption.created_at' => 'dia',
        ];

        foreach(request()->foods as $key => $value) {
            
            $attributes['foods.'.$key.'.amount_consumed'] = 'quantidade';

        }
        
        return $attributes;
    }
}
