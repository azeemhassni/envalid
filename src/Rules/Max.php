<?php

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class Max
 *
 * @package azi\Rules
 */
class Max implements RuleInterface
{
    protected $message;

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args)
    {
        $vars = $args->getVariables();

        if (!($value <= @$vars[ 0 ])) {
            $this->message = "{field} must be equal to or less than " . $vars[ 0 ];
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return "{field} is not in required range";
    }
}