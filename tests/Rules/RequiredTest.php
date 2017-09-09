<?php

namespace azi\Tests\Rules;

use azi\Tests\TestCase;

/**
 * Class RequiredTest
 *
 * @package azi\Tests\Rules
 */
class RequiredTest extends TestCase
{

    public function testItValidatesRequiredFields()
    {
        $this->validator->validate(['name' => 'Azeem Hassni'], [
            'name' => 'required'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    /**
     * @test
     */
    public function validationFailsWhenARequiredFieldIsEmpty()
    {
        $this->validator->validate(['name' => ''], [
            'name' => 'required'
        ]);

        $this->assertTrue($this->validator->failed());
    }

}