<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

class MinTest extends TestCase
{
    public function testItValidatesMinRangeFields()
    {
        $this->validator->validate(['number' => 500], [
            'number' => 'min:600'
        ]);

        $this->assertTrue($this->validator->failed());
    }

    public function testItValidatesMinRangePasses()
    {
        $this->validator->validate(['salary' => 100000], [
            'salary' => 'min:80000'
        ]);

        $this->assertTrue($this->validator->passed());
    }
}