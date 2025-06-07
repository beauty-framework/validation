<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;
use Beauty\Validation\MissingRequiredParameterException;

class Regex extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not valid format";

    /** @var array */
    protected array $fillableParams = ['regex'];

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
        $regex = $this->parameter('regex');
        return preg_match($regex, $value) > 0;
    }
}
