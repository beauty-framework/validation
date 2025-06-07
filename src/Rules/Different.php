<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class Different extends Rule
{

    /** @var string */
    protected string $message = "The :attribute must be different with :field";

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
        $anotherValue = $this->validation->getValue($field);

        return $value != $anotherValue;
    }
}
