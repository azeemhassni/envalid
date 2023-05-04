<?php


namespace Azi\Envalid\Tests\Rules;


use Azi\Envalid\Tests\TestCase;

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