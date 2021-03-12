<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileExceptType implements Rule
{
    public $exceptTypes=[];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($exceptTypes)
    {
        $this->exceptTypes=$exceptTypes;
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
       return !in_array($value->getClientOriginalExtension(),$this->exceptTypes);
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'It is impossible to load these types php,exe,bmp.';
    }
}
