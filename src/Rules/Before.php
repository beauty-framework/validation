<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Before extends Rule
{
    use Traits\DateUtilsTrait;

    /** @var string */
    protected string $message = "The :attribute must be a date before :time.";

    /** @var array */
    protected array $fillableParams = ['time'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws \Exception
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        $time = $this->parameter('time');

        if (!$this->isValidDate($value)) {
            throw $this->throwException($value);
        }

        if (!$this->isValidDate($time)) {
            throw $this->throwException($time);
        }

        return $this->getTimeStamp($time) > $this->getTimeStamp($value);
    }
}
