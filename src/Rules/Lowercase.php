<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Lowercase extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be lowercase";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return mb_strtolower($value, mb_detect_encoding($value)) === $value;
    }
}
