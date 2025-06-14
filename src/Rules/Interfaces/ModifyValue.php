<?php

namespace Beauty\Validation\Rules\Interfaces;

interface ModifyValue
{
    /**
     * Modify given value
     * so in current and next rules returned value will be used
     *
     * @param mixed $value
     * @return mixed
     */
    public function modifyValue(mixed$value): mixed;
}
