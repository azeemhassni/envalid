<?php

namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class MaxTest extends TestCase
{
    public function testItValidatesMaxRangeFields()
    {
        $this->validator->validate(['number' => 601], [
            'number' => 'max:600'
        ]);

        $this->assertTrue($this->validator->failed());
    }

    public function testItValidatesMaxRangePasses()
    {
        $this->validator->validate(['number' => 600], [
            'number' => 'max:1000'
        ]);

        $this->assertTrue($this->validator->passed());
    }
}