<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class Between extends Rule
{
    use Traits\SizeTrait;

    /** @var string */
    protected string $message = "The :attribute must be between :min and :max";

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

        $min = $this->getBytesSize($this->parameter('min'));
        $max = $this->getBytesSize($this->parameter('max'));

        $valueSize = $this->getValueSize($value);

        if (!is_numeric($valueSize)) {
            return false;
        }

        return ($valueSize >= $min && $valueSize <= $max);
    }
}
