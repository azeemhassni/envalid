<?php
/**
 * Created by PhpStorm.
 * User: azi
 * Date: 3/30/17
 * Time: 2:30 PM
 */

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