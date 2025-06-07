<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Accepted extends Rule
{
    /** @var bool */
    protected bool $implicit = true;

    /** @var string */
    protected string $message = "The :attribute must be accepted";

    /**
     * Check the $value is accepted
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        $acceptables = ['yes', 'on', '1', 1, true, 'true'];
        return in_array($value, $acceptables, true);
    }
}
