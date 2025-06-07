<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Json extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be a valid JSON string";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        if (! is_string($value) || empty($value)) {
            return false;
        }

        json_decode($value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return true;
    }
}
