<?php

namespace Azi\Envalid\Tests\Rules;


use Azi\Envalid\Tests\TestCase;

class IPTest extends TestCase
{
    public function testItValidatesIPAddress()
    {
        $this->validator->validate(['ip' => '127.0.0.1'], [
            'ip' => 'ip'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItFailsWhenAMalformedIPAddressIsGiven()
    {
        $this->validator->validate(['ip' => '127.x.y.z'], [
            'ip' => 'ip'
        ]);

        $this->assertTrue($this->validator->failed());
    }
}