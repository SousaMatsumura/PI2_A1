<?php

namespace App\Http\Requests\School\Meal;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
            'meal.createdAt' => ['required', 'date_format:d/m/Y'],
            'meal.breakfast.name' => ['required'],
            'meal.lunch.name' => ['required'],
            'meal.afternoon_snack.name' => ['required'],
            'meal.dinner.name' => ['required'],
            'meal.*.amount' => ['required', 'numeric'],
            'meal.*.repeat' => ['required', 'numeric']

        ];
    }

    public function attributes()
    {
        return [
            'meal.createdAt' => 'dia',
            'meal.breakfast.name' => "descrição da refeição",
            'meal.lunch.name' => "descrição da refeição",
            'meal.afternoon_snack.name' => "descrição da refeição",
            'meal.dinner.name' => "descrição da refeição",
            'meal.*.amount' => 'quantidade',
            'meal.*.repeat' => 'número de repetições'

        ];
    }
}
