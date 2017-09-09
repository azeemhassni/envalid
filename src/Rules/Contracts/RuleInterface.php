<?php

namespace azi\Rules\Contracts;

use azi\Arguments;

/**
 * Interface RuleContract
 *
 * @package azi\Rules\Contracts
 */
interface RuleInterface
{
    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $value, Arguments $args);

    /**
     * @return mixed
     */
    public function message();
}