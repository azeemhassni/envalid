<?php

namespace Azi\Envalid\Rules;

use Brazanation\Documents\Cnpj;
use Brazanation\Documents\Cpf;

class CPFCNPJ implements \Azi\Envalid\Rules\Contracts\RuleInterface
{

    /**
     * @inheritDoc
     */
    public function validate($field, $value, \Azi\Envalid\Arguments $args)
    {
        $cpf = Cpf::createFromString($value);
        $cnpj = Cnpj::createFromString($value);
        return $cpf !== false || $cnpj !== false;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'CPF OU CNPJ inválido';
    }
}