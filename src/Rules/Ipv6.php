<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Ipv6 extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not valid IPv6 Address";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}
