<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Rule;
use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\RuleNotFoundException;

class RequiredUnless extends Required
{
    /** @var bool */
    protected bool $implicit = true;

    /** @var string */
    protected string $message = "The :attribute is required";

    /**
     * Given $params and assign the $this->params
     *
     * @param array $params
     * @return self
     */
    public function fillParameters(array $params): Rule
    {
        $this->params['field'] = array_shift($params);
        $this->params['values'] = $params;
        return $this;
    }

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws MissingRequiredParameterException|RuleNotFoundException
     */
    public function check($value): bool
    {
        $this->requireParameters(['field', 'values']);

        $anotherAttribute = $this->parameter('field');
        $definedValues = $this->parameter('values');
        $anotherValue = $this->getAttribute()->getValue($anotherAttribute);

        $validator = $this->validation->getValidator();
        $requiredValidator = $validator('required');

        if (!in_array($anotherValue, $definedValues)) {
            $this->setAttributeAsRequired();
            return $requiredValidator->check($value, []);
        }

        return true;
    }
}
