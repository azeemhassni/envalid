<?php

namespace Azi\Envalid\Rules;


use Azi\Envalid\Arguments;
use Azi\Envalid\Rules\Contracts\RuleInterface;

/**
 * Class Alpha
 *
 * @package azi\Rules
 */
class Alpha implements RuleInterface
{

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        if (preg_match('#^([a-zA-Z\s])+$#', $value)) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return '{field} must be alpha';
    }
}