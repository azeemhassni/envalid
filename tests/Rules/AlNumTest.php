<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class AlNumTest extends TestCase
{
    public function testItValidatesAlNumFields()
    {
        $this->validator->validate(['block' => 'D3'], [
            'block' => 'alnum'
        ]);

        $this->assertTrue($this->validator->passed());
    }
}