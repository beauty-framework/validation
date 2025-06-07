<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;

class Present extends Rule
{
    /** @var bool */
    protected bool $implicit = true;

    /** @var string */
    protected string $message = "The :attribute must be present";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        $this->setAttributeAsRequired();

        return $this->validation->hasValue($this->attribute->getKey());
    }

    /**
     * Set attribute is required if $this->attribute is set
     *
     * @return void
     */
    protected function setAttributeAsRequired(): void
    {
        if ($this->attribute) {
            $this->attribute->setRequired(true);
        }
    }
}
