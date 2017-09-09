<?php

namespace azi\Tests\Rules;


use azi\Tests\TestCase;

/**
 * Class ArrayRuleTest
 *
 * @package azi\Tests\Rules
 */
class ArrayRuleTest extends TestCase
{

    public function testItValidatesArrays()
    {
        $this->validator->validate([
            'languages' => ['php', 'java', 'ruby', 'python', 'c']
        ], [
            'languages' => 'array'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesArrayContains()
    {
        $this->validator->validate([
            'languages' => ['php', 'java', 'ruby', 'python', 'c']
        ], [
            'languages' => 'array:php,javascript'
        ]);

        $this->assertTrue($this->validator->failed());

        $this->assertEquals('Languages must contain the following values php,javascript',
            $this->validator->getErrors()->get('languages')->first()
        );
    }


}