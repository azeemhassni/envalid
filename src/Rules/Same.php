<?php

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class Same
 *
 * @package azi\Rules
 */
class Same implements RuleInterface
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
        $vars    = $args->getVariables();
        $operand = $vars[ 0 ];
        $fields  = $args->getValidator()->getFields();

        if ($value != $fields[ $operand ]) {
            $this->message = "{field} must be same as " . $operand;
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        return '{field} is not same as its operand';
    }
}