<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Numeric extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be numeric";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return is_numeric($value);
    }
}
