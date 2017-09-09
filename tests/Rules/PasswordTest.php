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

    public function testItValidatesStrongPasswords()
    {
        $this->validator->validate(['new_password' => 'v3Ry$3cUr3'], [
            'new_password' => 'password:strong'
        ]);

        $this->assertTrue($this->validator->passed(), 'Failed to validate a strong password');
//
//        $this->validator->validate(['new_password' => '123'], [
//            'new_password' => 'password:strong'
//        ]);
//
//        $this->assertTrue($this->validator->failed());
    }

}