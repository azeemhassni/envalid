<?php

namespace Azi\Envalid\Rules;


use Azi\Envalid\Arguments;
use Azi\Envalid\Rules\Contracts\RuleInterface;

/**
 * Class Email
 *
 * @package azi\Rules
 */
class Email implements RuleInterface
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
        return !!filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return string
     */
    public function message()
    {
        return "{field} must be a valid email address";
    }
}