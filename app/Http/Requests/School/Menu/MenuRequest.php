<?php

namespace App\Http\Requests\School\Menu;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu.created_at' => ['required', 'date_format:d/m/Y'],
            'meal.breakfast.description' => ['required'],
            'meal.lunch.description' => ['required'],
            'meal.afternoon_snack.description' => ['required'],
            'meal.dinner.description' => ['required'],
            'meal.*.amount' => ['required', 'numeric'],
            'meal.*.repeat' => ['required', 'numeric']

        ];
    }

    public function attributes()
    {
        return [
            'menu.created_at' => 'data',
            'meal.breakfast.description' => 'café da manhã',
            'meal.lunch.description' => 'almoço',
            'meal.afternoon_snack.description' => 'lanche da tarde',
            'meal.dinner.description' => 'jantar',
            'meal.*.amount' => 'quantidade',
            'meal.*.repeat' => 'repetições'
        ];
    }
}
