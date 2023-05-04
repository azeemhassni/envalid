<?php

namespace Azi\Envalid\Rules;
class Phone implements \Azi\Envalid\Rules\Contracts\RuleInterface
{

    /**
     * @inheritDoc
     */
    public function validate($field, $value, \Azi\Envalid\Arguments $args)
    {
        $phone = preg_replace('/\D+/', '', $value);
        return (bool) preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:(?:\(?[1-9][0-9]\)?)?\s?)?(?:((?:9\d|[2-9])\d{3})-?(\d{4}))$/', $phone);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'Telefone inválido';
    }
}