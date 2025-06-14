<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Email extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not valid email";

    /**
     * Check $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
