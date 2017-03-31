<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class AlphaTest extends TestCase
{
    public function testItValidatesAlphaFields()
    {
        $this->validator->validate(['name' => 'Azeem Hassni'], [
            'name' => 'alpha'
        ]);

        $this->assertTrue($this->validator->passed());
    }
}