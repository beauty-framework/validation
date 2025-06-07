<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rule;

class Required extends Rule
{

    public function check($value): bool
    {
        return true;
    }
}
