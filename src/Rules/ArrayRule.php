<?php
/**
 * Created by PhpStorm.
 * User: azi
 * Date: 3/28/17
 * Time: 11:51 AM
 */

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

class ArrayRule implements RuleInterface
{
    protected $contains = [];
    protected $validationType = 'array';

    /**
     * @param $field
     * @param $value
     * @param Arguments $args
     * @return mixed
     */
    public function validate( $field, $value, Arguments $args )
    {
        if ($args->has('variables')) {
            $contains             = explode(',', $args->get('variables')[ 0 ]);
            $this->contains       = $contains;
            $this->validationType = 'contains';
            return count(array_intersect($value, $contains)) == count($contains);
        }

        return is_array($value);
    }

    /**
     * @return mixed
     */
    public function message()
    {
        if ($this->validationType == 'contains') {
            return '{field} must contain the following values ' . implode(',',$this->contains);
        }

        return "{field} must be an array";
    }
}