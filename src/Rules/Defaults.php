<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;
use Beauty\Validation\Rules\Interfaces\ModifyValue;

class Defaults extends Rule implements ModifyValue
{

    /** @var string */
    protected string $message = "The :attribute default is :default";

    /** @var array */
    protected array $fillableParams = ['default'];

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

        $default = $this->parameter('default');
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function modifyValue($value): mixed
    {
        return $this->isEmptyValue($value) ? $this->parameter('default') : $value;
    }

    /**
     * Check $value is empty value
     *
     * @param mixed $value
     * @return boolean
     */
    protected function isEmptyValue($value): bool
    {
        $requiredValidator = new Required;
        return false === $requiredValidator->check($value, []);
    }
}
