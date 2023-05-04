<?php

namespace Azi\Envalid\Rules;

class CEP implements \Azi\Envalid\Rules\Contracts\RuleInterface
{

    /**
     * @inheritDoc
     */
    public function validate($field, $value, \Azi\Envalid\Arguments $args)
    {
        return (bool) preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $value);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'CEP inválido!';
    }
}