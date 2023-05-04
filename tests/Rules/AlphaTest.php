<?php


namespace Azi\Envalid\Tests\Rules;


use Azi\Envalid\Tests\TestCase;

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