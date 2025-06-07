<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class TypeArray extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be array";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return is_array($value);
    }
}
