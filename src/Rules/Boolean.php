<?php

namespace azi\Rules;

use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class Boolean
 *
 * @package azi\Rules
 */
class Boolean implements RuleInterface
{

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        if (!isset($args[ 'variables' ][ 0 ])) {
            return is_bool($value);
        }

        $expected = $args[ 'variables' ][ 0 ] == 'true' ? true : false;
        return $value === $expected;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return '{field} must be boolean';
    }
}