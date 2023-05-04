<?php

namespace Azi\Envalid\Rules;
class UF implements \Azi\Envalid\Rules\Contracts\RuleInterface
{

    /**
     * @inheritDoc
     */
    public function validate($field, $value, \Azi\Envalid\Arguments $args)
    {
        return (bool) preg_match('{^A[CLMP]|BA|CE|DF|ES|[GT]O|M[AGST]|P[ABEIR]|R[JNORS]|S[CEP]$}', $value) != false;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'UF Inválido';
    }
}