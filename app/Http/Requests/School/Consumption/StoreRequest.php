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
            'food_record.created_at' => ['required', 'date_format:d/m/Y'],
        ];

        /**foreach(request()->foods as $key => $value) {
            
            $inventoryItems = Auth::user()->school->inventories()->select('food_id', 'quantity')->get();

            $maxQuantity = $inventoryItems->where('food_id', $key)->first()->quantity;
            
            $rules['foods.'.$key.'.quantity'] = ['numeric', 'min:0', 'max:'.$maxQuantity.''];

        }*/

        return $rules;
    }

    public function attributes()
    {

        $attributes = [
            'food_record.created_at' => 'dia',
        ];

        /**foreach(request()->foods as $key => $value) {
            
            $attributes['foods.'.$key.'.quantity'] = 'quantidade';

        }*/
        
        return $attributes;
    }
}
