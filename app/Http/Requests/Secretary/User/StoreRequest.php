<?php

namespace App\Http\Requests\Secretary\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Phone;

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
        return [
            'user.name' => ['required'],
            'user.institution_id' => ['required', 'exists:institutions,id'],
            'user.email' => ['required', 'email', 'unique:users,email'],
            'user.phone' => ['required', new Phone()],
            'user.username' => ['required', 'unique:users,username'],
            'user.password' => ['required', 'min:8']
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
