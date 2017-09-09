<?php namespace azi\Tests;

use azi\Arguments;

/**
 * Tests for azi\Validator
 * Class ValidatorTest
 *
 * @package azi
 */
class EnvalidTest extends TestCase
{
    public function testItAcceptsRules()
    {
        $this->validator->validate(['name' => 'azeem@example.com'], [
            'name' => 'required'
        ]);
        $this->assertEquals(['name' => 'required'], $this->validator->getRules());
    }

    public function testItAcceptsArguments()
    {
        $this->validator->validate(['name' => false], [
            'name' => 'required--message=Please type your name'
        ]);

        $errors = $this->validator->getErrors();

        $this->assertEquals('Please type your name', $errors->get('name')[ 0 ]);
    }

    public function testItSendsMultipleErrorMessagesAtTheSameTime()
    {
        $this->validator->validate(['email' => null], [
            'email' => 'required|email'
        ]);

        $errors = $this->validator->getErrors();

        $this->assertEquals('Email is required', $errors->get('email')->first());
        $this->assertEquals('Email must be a valid email address', $errors->get('email')->last());
    }

    public function testItAllowsCallableCustomRules()
    {
        $this->validator->addRule('one_to_ten', function ($field, $value, Arguments $args) {
            if ($value >= 1 && $value <= 10) {
                return true;
            }

            return "{field} must be between 1-10";
        });

        $this->validator->validate(['kid_age' => '5'], [
            'kid_age' => 'one_to_ten'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesRequiredFields()
    {
        $this->validator->validate(['name' => 'Azeem Hassni'], [
            'name' => 'required'
        ]);

        $this->assertTrue($this->validator->passed());


        $this->validator->validate(['name' => null], [
            'name' => 'required'
        ]);

        $this->assertTrue($this->validator->failed());
    }

    public function testItValidatesEmailFields()
    {
        $this->validator->validate(['email_address' => 'john@example.com'], [
            'email_address' => 'required|email'
        ]);

        $this->assertTrue($this->validator->passed());

        $this->validator->validate(['email_address' => 'some text'], [
            'email_address' => 'email'
        ]);

        $this->assertTrue($this->validator->failed());
    }

    public function testTheErrorBagIsJsonSerializable()
    {
        $this->validator->validate([
            'name' => null
        ], [
            'name' => 'required'
        ]);

        $errors = $this->validator->getErrors();

        $errorsJson = json_encode($errors);
        $this->assertJson($errorsJson);

        $errors   = json_decode($errorsJson);
        $expected = (object)['name' => ['Name is required']];
        $this->assertEquals($expected, $errors);
    }
}