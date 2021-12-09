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
            'menu.created_at' => ['required', 'date_format:d/m/Y', 'after_or_equal:'.now()->subDays(7)->format('d/m/Y'), 'before_or_equal:'.now()->format('d/m/Y')],
            'meals.breakfast.description' => ['required'],
            'meals.lunch.description' => ['required'],
            'meals.afternoon_snack.description' => ['required'],
            'meals.dinner.description' => ['required'],
            'meals.*.amount' => ['required', 'numeric'],
            'meals.*.repeat' => ['required', 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'menu.created_at' => 'dia',
            'meals.breakfast.description' => 'lanche da manhã',
            'meals.lunch.description' => 'almoço',
            'meals.afternoon_snack.description' => 'lanche da tarde',
            'meals.dinner.description' => 'janta',
            'meals.*.amount' => 'quantidade',
            'meals.*.repeat' => 'repetições'
        ];
    }
}
