<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Uppercase extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be uppercase";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        return mb_strtoupper($value, mb_detect_encoding($value)) === $value;
    }
}
