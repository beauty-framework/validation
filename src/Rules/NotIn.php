<?php

namespace Beauty\Validation\Rules;

use Beauty\Validation\Helper;
use Beauty\Validation\MissingRequiredParameterException;
use Beauty\Validation\Rule;

class NotIn extends Rule
{

    /** @var string */
    protected string $message = "The :attribute is not allowing :disallowed_values";

    /** @var bool */
    protected bool $strict = false;

    /**
     * Given $params and assign the $this->params
     *
     * @param array $params
     * @return self
     */
    public function fillParameters(array $params): Rule
    {
        if (count($params) == 1 and is_array($params[0])) {
            $params = $params[0];
        }
        $this->params['disallowed_values'] = $params;
        return $this;
    }

    /**
     * Set strict value
     *
     * @param bool $strict
     * @return void
     */
    public function strict($strict = true)
    {
        $this->strict = $strict;
    }

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws MissingRequiredParameterException
     */
    public function check($value): bool
    {
        $this->requireParameters(['disallowed_values']);

        $disallowedValues = (array) $this->parameter('disallowed_values');

        $and = $this->validation ? $this->validation->getTranslation('and') : 'and';
        $disallowedValuesText = Helper::join(Helper::wraps($disallowedValues, "'"), ', ', ", {$and} ");
        $this->setParameterText('disallowed_values', $disallowedValuesText);

        return !in_array($value, $disallowedValues, $this->strict);
    }
}
