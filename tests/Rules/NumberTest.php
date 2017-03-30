<?php

namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class NumberTest extends TestCase
{
    public function testItValidatesIfTheGivenIsANumber()
    {
        $this->validator->validate(['salary' => 500000], [
            'salary' => 'number'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesIfTheGivenIsNumericString()
    {
        $this->validator->validate(['salary' => '500000'], [
            'salary' => 'number'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesIfTheGivenIsNotANumber()
    {
        $this->validator->validate(['salary' => 'STRING'], [
            'salary' => 'number'
        ]);

        $this->assertTrue($this->validator->failed());
    }

    public function testItValidatesIfTheGivenIsFloat()
    {
        $this->validator->validate(['salary' => '1.00'], [
            'salary' => 'number'
        ]);

        $this->assertTrue($this->validator->passed());
    }

}