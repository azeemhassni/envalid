<?php

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class IP
 *
 * @package azi\Rules
 */
class IP implements RuleInterface
{

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return '{field} must be an IP address';
    }
}