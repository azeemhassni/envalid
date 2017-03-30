<?php
/**
 * Created by PhpStorm.
 * User: azi
 * Date: 3/29/17
 * Time: 3:11 PM
 */

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