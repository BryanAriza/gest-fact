<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoDecimalPointOrComma implements Rule
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
        // Verifica si el valor contiene punto o coma decimal
        return !preg_match('/[\.,]/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute no puede contener puntos ni comas.';
    }
}
