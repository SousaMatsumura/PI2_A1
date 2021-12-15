<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Zipcode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^\d{2}\.?\d{3}-\d{3}$/', $value) > 0;
    }

    public function message()
    {
    	return 'O campo :attribute não é um CEP válido.';
        
    }
}
