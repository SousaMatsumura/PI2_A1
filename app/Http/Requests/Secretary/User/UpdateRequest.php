<?php

namespace App\Http\Requests\Secretary\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Phone;

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
        return [
            'user.name' => ['required'],
            'user.institution_id' => ['required', 'exists:institutions,id'],
            'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore(request()->route()->parameter('user'))],
            'user.phone' => ['required', new Phone()],
            'user.username' => ['required', Rule::unique('users', 'username')->ignore(request()->route()->parameter('user'))],
            'user.password' => ['nullable', 'min:8']
        ];
    }

    public function attributes()
    {
        return [
            'user.name' => 'nome',
            'user.institution_id' => 'escola / instituição',
            'user.email' => 'email',
            'user.phone' => 'telefone',
            'user.username' => 'username',
            'user.password' => 'senha'
        ];
    }
}
