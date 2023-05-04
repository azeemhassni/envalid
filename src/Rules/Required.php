<?php

namespace Azi\Envalid\Rules;

use Azi\Envalid\Arguments;
use Azi\Envalid\Rules\Contracts\RuleInterface;

/**
 * Class Required
 *
 * @package azi\Rules
 */
class Required implements RuleInterface
{
    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        return !empty($value);
    }

    /**
     * @return string
     */
    public function message()
    {
        return "{field} is required";
    }
}