<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class DigitsBetween extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must have a length between the given :min and :max";

    /** @var array */
    protected array $fillableParams = ['min', 'max'];

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

        $min = (int) $this->parameter('min');
        $max = (int) $this->parameter('max');

        $length = strlen((string) $value);

        return ! preg_match('/[^0-9]/', $value)
                    && $length >= $min && $length <= $max;
    }
}
