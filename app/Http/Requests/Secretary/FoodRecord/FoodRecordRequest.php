<?php

namespace App\Http\Requests\Secretary\FoodRecord;

use Illuminate\Foundation\Http\FormRequest;

class FoodRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'food_record.created_at' => ['required', 'date_format:d/m/Y', 'date_equals:'.now()->format('d/m/Y')],
            'foods.*.amount' => ['nullable', 'numeric']
        ];

    }

    public function attributes()
    {
        return [
            'food_record.created_at' => 'dia',
            'foods.*.amount' => 'entrada'
        ];
    }
}
