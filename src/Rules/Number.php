<?php

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class Number
 *
 * @package azi\Rules
 */
class Number implements RuleInterface
{

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        return is_numeric($value);
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return '{field} must be valid number';
    }
}