<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class SameTest extends TestCase
{
    public function testItValidatesSameRule()
    {
        $this->validator->validate([
            'password'         => 'password123',
            'confirm_password' => 'password123'
        ], [
            'confirm_password' => 'same:password'
        ]);

        $this->assertTrue($this->validator->passed());
    }
}