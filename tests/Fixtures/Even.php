<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rule;

class Even extends Rule
{

    protected string $message = "The :attribute must be even";

    public function check($value): bool
    {
        if (! is_numeric($value)) {
            return false;
        }

        return $value % 2 === 0;
    }
}
