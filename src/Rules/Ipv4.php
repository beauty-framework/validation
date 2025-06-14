<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Ipv4 extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not valid IPv4 Address";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}
