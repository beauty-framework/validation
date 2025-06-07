<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;
use Beauty\Validation\MissingRequiredParameterException;

class Same extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be same with :field";

    /** @var array */
    protected array $fillableParams = ['field'];

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

        $field = $this->parameter('field');
        $anotherValue = $this->getAttribute()->getValue($field);

        return $value == $anotherValue;
    }
}
