<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{

    protected $forbidden;
    public function __construct(array $forbidden)
    {
        $this->forbidden = $forbidden;
    } // end of constructor

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! in_array(strtolower($value), $this->forbidden);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This name is not allowed.';
    }
}
