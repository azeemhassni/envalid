<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class PasswordTest extends TestCase
{
    public function testItValidatesASecurePasswordWithoutPassingStrength()
    {
        $this->validator->validate(['new_password' => 'azeemhassni'], [
            'new_password' => 'password'
        ]);

        $this->assertTrue($this->validator->passed());
    }

}