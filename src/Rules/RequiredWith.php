<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;
use Beauty\Validation\RuleNotFoundException;

class RequiredWith extends Required
{
    /** @var bool */
    protected bool $implicit = true;

    /** @var string */
    protected string $message = "The :attribute is required";

    /**
     * Given $params and assign $this->params
     *
     * @param array $params
     * @return self
     */
    public function fillParameters(array $params): Rule
    {
        $this->params['fields'] = $params;
        return $this;
    }

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws MissingRequiredParameterException
     * @throws RuleNotFoundException
     */
    public function check($value): bool
    {
        $this->requireParameters(['fields']);
        $fields = $this->parameter('fields');
        $validator = $this->validation->getValidator();
        $requiredValidator = $validator('required');

        foreach ($fields as $field) {
            if ($this->validation->hasValue($field)) {
                $this->setAttributeAsRequired();
                return $requiredValidator->check($value, []);
            }
        }

        return true;
    }
}
