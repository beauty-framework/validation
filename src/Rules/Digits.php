<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class Digits extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be numeric and must have an exact length of :length";

    /** @var array */
    protected array $fillableParams = ['length'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws MissingRequiredParameterException
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);

        $length = (int) $this->parameter('length');

        return ! preg_match('/[^0-9]/', $value)
                    && strlen((string) $value) == $length;
    }
}
