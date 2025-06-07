<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class Max extends Rule
{
    use Traits\SizeTrait;

    /** @var string */
    protected string $message = "The :attribute maximum is :max";

    /** @var array */
    protected array $fillableParams = ['max'];

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

        $max = $this->getBytesSize($this->parameter('max'));
        $valueSize = $this->getValueSize($value);

        if (!is_numeric($valueSize)) {
            return false;
        }

        return $valueSize <= $max;
    }
}
