<?php


namespace Azi\Envalid\Tests\Rules;


use Azi\Envalid\Tests\TestCase;

class BooleanTest extends TestCase
{
    public function testItValidatesBooleanFields()
    {
        $this->validator->validate([
            'can_vote' => true,
        ], [
            'can_vote' => 'boolean'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesTrueValues()
    {

        $this->validator->validate([
            'can_vote' => false,
        ], [
            'can_vote' => 'bool:false'
        ]);

        $this->assertTrue($this->validator->passed());

    }
}