<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Ip extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not valid IP Address";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }
}
